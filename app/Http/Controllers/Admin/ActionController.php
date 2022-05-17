<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Rental Action | ' . config('app.name'),
        ];

        return view('Admin.RentalAction.index', $data);
    }

    public function getRental()
    {
        if (!request()->ajax()) {
            return redirect()->to(route('rentalAction'));
        }
        return view('Admin.RentalAction.Ajax.main-table', [
            'rental' => Rental::with(['vehicleSpec', 'payment', 'user'])->where('transaction_code', 'like', '%' . str_replace('#', '', urldecode(request()->search)) . '%')->first()
        ]);
    }

    public function edit($id)
    {
        return view('Admin.RentalAction.Ajax.edit-form', [
            'rental' => Rental::with(['vehicleSpec', 'payment', 'user'])->find($id)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'rental_status' => 'required'
        ]);

        if ($request->rental_status == 'Rejected' || $request->rental_status == 'Returned') {
            $request->validate(['reason' => 'required']);
        }

        if ($request->rental_status == 'In Use') {
            $queryRental = [
                'status' => $request->rental_status,
                'vehicle_picked' => date('Y-m-d H:i:s')
            ];
        } else if ($request->rental_status == 'Returned') {
            $queryRental = [
                'status' => $request->rental_status,
                'reason' => $request->reason,
                'vehicle_returned' => date('Y-m-d H:i:s')
            ];
            $queryVehicle = [
                'vehicle_status' => 'Available'
            ];
        } else if ($request->rental_status == 'Rejected') {
            $queryRental = [
                'status' => $request->rental_status,
                'reason' => $request->reason,
            ];
            $queryVehicle = [
                'vehicle_status' => 'Available'
            ];
        } else if ($request->rental_status == 'Completed') {
            $queryRental = [
                'status' => $request->rental_status,
                'vehicle_returned' => date('Y-m-d H:i:s')
            ];
            $queryVehicle = [
                'vehicle_status' => 'Available'
            ];
        }

        Rental::find($request->id)->update($queryRental);
        if (isset($queryVehicle) && !is_null($queryVehicle)) {
            VehicleSpec::find($request->id_vehicle)->update($queryVehicle);
        }
    }
}