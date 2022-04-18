<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Payment::with('rental')->get();
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
    public function show($paymentCode)
    {
        $payment = Payment::where('payment_code', $paymentCode)->with('rental')->first();

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
    public function update(Request $request, $id)
    {
        if (!Rental::find($request->id_rental)) {
            return response(['message' => 'Data rental was not found.'], 401);
        }

        if (!Payment::where('payment_code', $request->payment_code)) {
            return response(['message' => 'Data payment was not found.'], 401);
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

        if (Payment::where('payment_code', $request->payment_code)->update($validated)) {
            return True;
        } else {
            return False;
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