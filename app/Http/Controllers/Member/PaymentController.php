<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;

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

        return view('Guest.pay-form', $data);
    }

    public function payProcess(Request $request)
    {
        if (Payment::where('transaction_code', $request->transaction_code)->first()) {
            return redirect()->to(route('historyDetail', $request->transaction_code))->with('info', 'Invoice has been payed');
        }

        $validation = $request->validate([
            'transaction_code' => 'required',
            'id_rental' => 'required',
            'cashier' => 'required',
            'payment_type' => 'required',
            'paid_date' => 'required',
            'payer_name' => 'required',
            'bank' => 'required',
            'no_ref' => 'required',
            'paid_total' => 'required',
        ]);

        if (Payment::create($validation)) {
            return redirect()->to(route('historyDetail', $request->transaction_code))->with('success', 'Payment Accepted!');
        }
    }
}
