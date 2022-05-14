<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RentalController extends Controller
{

    public function vehicleSingle($slug)
    {
        $vehicle = VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_slug', $slug)->where('vehicle_status', 'Available');

        if (!$vehicle->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not found!');
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not available!');
        }

        $data = [
            'title' => $vehicle->first()->vehicle_name . ' | ' . config('app.name'),
            'vehicle' => $vehicle->first(),
            'related' => VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_status', 'Available')->inRandomOrder()->limit(3)->get()
        ];

        return view('Guest.vehicle-single', $data);
    }

    public function rentalForm($slug)
    {
        $vehicle = VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_slug', $slug);

        if (!$vehicle->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not found!');
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not available!');
        }

        if (auth()->user()->role == 'Admin') {
            return redirect()->to(route('vehicleSingle', $slug))->with('error', 'You are Admin!');
        }

        $data = [
            'title' => $vehicle->first()->vehicle_name . ' | ' . config('app.name'),
            'vehicle' => $vehicle->first(),
        ];

        return view('Guest.rental-form', $data);
    }

    public function createInvoice(Request $request)
    {
        if (auth()->user()->kyc == null) {
            return redirect()->to(route('profile'))->with('error', 'You need to identity verify');
        }

        $vehicle = VehicleSpec::where('id', $request->id_vehicle);

        if (!$vehicle->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not found!');
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not available!');
        }

        // Create Code
        $lastMaxCode = Rental::all()->max('transaction_code');
        $transaction_code = (int) substr($lastMaxCode, 3, 9);
        $transaction_code++;
        $trxCode = 'TRX' . sprintf('%09s', $transaction_code);

        $query = new Rental();
        $query->transaction_code = $trxCode;
        $query->user_id = auth()->user()->id;
        $query->id_vehicle = $request->id_vehicle;
        $query->start_rent_date = $request->start_rent_date;
        $query->end_rent_date = $request->end_rent_date;
        $query->status = 'Not Picked';

        if ($request->hasFile('guarante_rent_1')) {
            $query->guarante_rent_1 = $request->file('guarante_rent_1')->storeAs('guarante-ktp', 'KTP-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth()->user()->name) . '.' . $request->file('guarante_rent_1')->getClientOriginalExtension());
        } else if ($request->hasFile('guarante_rent_2')) {
            $query->guarante_rent_2 = $request->file('guarante_rent_2')->storeAs('guarante-sim', 'SIM-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth()->user()->name) . '.' . $request->file('guarante_rent_2')->getClientOriginalExtension());
        } else if ($request->hasFile('guarante_rent_3')) {
            $query->guarante_rent_3 = $request->file('guarante_rent_3')->storeAs('guarante-kk', 'KK-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth()->user()->name) . '.' . $request->file('guarante_rent_3')->getClientOriginalExtension());
        }
        $query->rent_price = $request->totalAmount;
        $query->save();

        VehicleSpec::where('id', $request->id_vehicle)->update(['vehicle_status' => 'Not Available']);

        return redirect()->to(route('viewInvoice', $trxCode));
    }

    public function viewInvoice($trxCode)
    {
        $rental = Rental::with(['vehicleSpec', 'payment'])->where('transaction_code', $trxCode)->first();

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

        return view('Guest.invoice', $data);
    }
}