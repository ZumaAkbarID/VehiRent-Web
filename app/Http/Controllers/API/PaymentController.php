<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_user_invoice()
    {
        if (request()->limit) {
            return Rental::with(['payment', 'vehicleSpec'])->where('user_id', auth('sanctum')->user()->id)->limit(request()->limit)->get();
        } else {
            return Rental::with(['payment', 'vehicleSpec'])->where('user_id', auth('sanctum')->user()->id)->get();
        }
    }

    public function invoice(Request $request, $trxCode)
    {
        $rental = Rental::with(['vehicleSpec', 'payment'])->where('transaction_code', $trxCode)->first();
        if (!$rental) {
            return response(['message' => 'Invoice with code ' . $trxCode . ' not found!'], 401);
        }

        if (isset($rental->payment->transaction_code)) {
            $status = 'Paid';
        } else {
            $status = 'Unpaid';
        }

        $startDate = strtotime($rental->start_rent_date);
        $endDate = strtotime($rental->end_rent_date);

        $timeDiff = abs($startDate - $endDate);
        $numberDays = $timeDiff / 86400;
        $numberDays = intval($numberDays);

        $data = [
            'transaction_code' => $trxCode,
            'rental' => $rental,
            'status' => $status,
            'vehicle' => $rental->vehicleSpec,
            'numberDays' => $numberDays
        ];

        return response(['message' => 'Success', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Rental::find($request->id_rental)) {
            return response(['message' => 'Data rental was not found.'], 401);
        }

        $validated = $request->validate([
            'id_rental' => 'required|numeric',
            'cashier' => 'required|string',
            'payment_type' => 'required|string',
            'paid_date' => 'required',
            'payer_name' => 'required|string',
            'bank' => 'required|string',
            'no_rek' => 'required',
            'paid_total' => 'required|numeric',
        ]);
        $validated['updated_at'] = null;

        // Create Code
        $lastMaxCode = Payment::all()->max('payment_code');
        $orderCode = (int) substr($lastMaxCode, 2, 2);
        $orderCode++;
        $validated['payment_code'] = 'TR' . sprintf('%09s', $orderCode);

        if (Payment::create($validated)) {
            return True;
        } else {
            return False;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($trxCode)
    {
        $payment = Rental::where('transaction_code', $trxCode)->where('user_id', auth('sanctum')->user()->id)->with('payment')->first();

        if (!$payment) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        return $payment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transaction_code)
    {
        if (Payment::where('transaction_code', $transaction_code)->first()) {
            return response(['message' => 'Invoice has been payed'], 401);
        }

        $request->request->add([
            'cashier' => config('app.name') . ' Mobile Payments',
            'payment_type' => 'Mobile',
            'paid_date' => now(),
            'bank' => config('app.name') . ' Bank',
            'no_ref' => time(),
        ]);

        $validation = $this->validate($request, [
            'cashier' => 'required',
            'payment_type' => 'required',
            'paid_date' => 'required',
            'payer_name' => 'required',
            'bank' => 'required',
            'no_ref' => 'required',
            'amount' => 'required',
            'payment_proof' => 'required|file|image|mimes:png,jpg,jpeg,pdf',
        ]);

        $rental = Rental::where('transaction_code', $transaction_code)->first();

        $validation['id_rental'] = $rental->id;
        $validation['no_ref'] = time();
        $validation['paid_date'] = now();
        $validation['transaction_code'] = $transaction_code;
        $validation['paid_total'] = $rental->rent_price;
        $validation['payment_proof'] = $request->file('payment_proof')->storeAs('payment_proof', Str::slug(auth()->user()->name . ' ' . time()) . '.' . $request->file('payment_proof')->getClientOriginalExtension());

        if ($rental->rent_price > $request->amount) {
            return response(['status' => 'Failed', 'message' => 'Your money is not enough', 'required' => $rental->rent_price, 'your_money' => $request->amount, 'cashback' => 0]);
        } else if ($rental->rent_price < $request->amount) {
            return response(['status' => 'Success', 'message' => 'Your money is to much', 'required' => $rental->rent_price, 'your_money' => $request->amount, 'cashback' => $request->amount - $rental->rent_price]);
        }

        if (Payment::create($validation)) {
            return response(['status' => 'Success', 'message' => 'Thank You', 'required' => $rental->rent_price, 'your_money' => $request->amount, 'cashback' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($paymentCode)
    {
        $payment = Payment::where('payment_code', $paymentCode)->first();

        if (!$payment) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        if ($payment->delete()) {
            return True;
        } else {
            return False;
        }
    }
}