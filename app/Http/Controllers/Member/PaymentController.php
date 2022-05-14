<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['isMember', 'auth', 'isEmailVerified']);
    }

    public function pay($trxCode)
    {
        if (Payment::where('transaction_code', $trxCode)->first()) {
            return redirect()->to(route('historyDetail', $trxCode))->with('info', 'Invoice has been payed');
        }

        $data = [
            'title' => 'Payment | ' . $trxCode,
            'rental' => Rental::where('transaction_code', $trxCode)->first()
        ];

        // return view('Guest.pay-form', $data);
        return view('Member.pay-form', $data);
    }

    public function payProcess(Request $request)
    {
        if (Payment::where('transaction_code', $request->transaction_code)->first()) {
            return redirect()->to(route('historyDetail', $request->transaction_code))->with('info', 'Invoice has been payed');
        }

        $request->request->add([
            'cashier' => config('app.name') . ' Web Payments',
            'payment_type' => 'Manual',
            'paid_date' => now(),
            'bank' => config('app.name') . ' Bank',
            'no_ref' => time(),
        ]);

        $validation = $this->validate($request, [
            'transaction_code' => 'required',
            'id_rental' => 'required',
            'cashier' => 'required',
            'payment_type' => 'required',
            'paid_date' => 'required',
            'payer_name' => 'required',
            'bank' => 'required',
            'no_ref' => 'required',
            'paid_total' => 'required',
            'payment_proof' => 'required|file|image|mimes:png,jpg,jpeg,pdf',
        ]);

        $validation['payment_proof'] = $request->file('payment_proof')->storeAs('payment_proof', Str::slug(auth()->user()->name . ' ' . time()) . '.' . $request->file('payment_proof')->getClientOriginalExtension());

        if (Payment::create($validation)) {
            return redirect()->to(route('historyDetail', $request->transaction_code))->with('success', 'Payment Accepted!');
        }
    }
}