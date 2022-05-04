<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Rental;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Transaction | ' . config('app.name'),
            'transaction' => Rental::with(['vehicleSpec', 'payment'])->get()
        ];

        return view('Admin.transaction', $data);
    }

    public function transaction($transaction_code)
    {
        $transaction = Rental::where('transaction_code', $transaction_code)->with(['vehicleSpec', 'payment'])->first();

        $vehicleSpec = VehicleSpec::where('id', $transaction->id_vehicle)->with('type')->first();

        $data = [
            'title' => $transaction_code . ' | ' . config('app.name'),
            'transaction' => $transaction,
            'vehicle' => $vehicleSpec,
            'brand' => Brand::where('id', $vehicleSpec->id_brand)->with('type')->first()
        ];

        return view('Admin.transaction-single', $data);
    }
}