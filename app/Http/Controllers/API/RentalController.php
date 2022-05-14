<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->limit) {
            return Rental::with(['vehiclespec'])->limit(request()->limit)->get();
        } else {
            return Rental::with(['vehiclespec'])->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $vehicle_slug)
    {
        if (auth()->user()->kyc == null) {
            return response([
                'status' => 'Failed',
                'message' => 'You need to identity verify'
            ], 403);
        }
        $this->validate($request, [
            'start_rent_date' => 'required',
            'end_rent_date' => 'required',
            'guarante_rent_1' => 'required|file|mimes:jpg,png,jpeg,pdf',
            'totalAmount' => 'required'
        ]);

        $vehicle = VehicleSpec::where('vehicle_slug', $vehicle_slug);
        if (!$vehicle->first()) {
            return response(['message' => 'Data vehicle was not found.'], 401);
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return response(['message' => 'Vehicle not available to rental.'], 401);
        }

        // Create Code
        $lastMaxCode = Rental::all()->max('transaction_code');
        $transaction_code = (int) substr($lastMaxCode, 3, 9);
        $transaction_code++;
        $trxCode = 'TRX' . sprintf('%09s', $transaction_code);

        $query = new Rental();
        $query->transaction_code = $trxCode;
        $query->user_id = auth('sanctum')->user()->id;
        $query->id_vehicle = $vehicle->first()->id;
        $query->start_rent_date = $request->start_rent_date;
        $query->end_rent_date = $request->end_rent_date;
        $query->status = 'Not Picked';

        if ($request->hasFile('guarante_rent_1')) {
            $query->guarante_rent_1 = $request->file('guarante_rent_1')->storeAs('guarante-ktp', 'KTP-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth('sanctum')->user()->name) . '.' . $request->file('guarante_rent_1')->getClientOriginalExtension());
        } else if ($request->hasFile('guarante_rent_2')) {
            $query->guarante_rent_2 = $request->file('guarante_rent_2')->storeAs('guarante-sim', 'SIM-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth('sanctum')->user()->name) . '.' . $request->file('guarante_rent_2')->getClientOriginalExtension());
            $this->validate($request, ['guarante_rent_2' => 'required|file|mimes:jpg,png,jpeg,pdf']);
        } else if ($request->hasFile('guarante_rent_3')) {
            $query->guarante_rent_3 = $request->file('guarante_rent_3')->storeAs('guarante-kk', 'KK-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth('sanctum')->user()->name) . '.' . $request->file('guarante_rent_3')->getClientOriginalExtension());
            $this->validate($request, ['guarante_rent_3' => 'required|file|mimes:jpg,png,jpeg,pdf']);
        }
        $query->rent_price = $request->totalAmount;

        if ($query->save() && $vehicle->where('vehicle_status', 'Available')->first()->update(['vehicle_status' => 'Not Available'])) {
            return response(['message' => 'Success.', 'invoice_code' => $trxCode], 200);
        } else {
            return response(['message' => 'Server error cannot create rental.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rental = Rental::where('id', $id)->with(['vehiclespec', 'payment'])->first();

        if (!$rental) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        return $rental;
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
        if (!VehicleSpec::find($request->id_vehicle)) {
            return response(['message' => 'Data vehicle was not found.'], 401);
        }

        if (!User::find($request->id_user)) {
            return response(['message' => 'Data user was not found.'], 401);
        }

        $rental = Rental::where('id', $id);
        $oldGuarante1 = $rental->first()->guarante_rent_1;
        $oldGuarante2 = $rental->first()->guarante_rent_2;
        $oldGuarante3 = $rental->first()->guarante_rent_3;

        $validated = $request->validate([
            'id_vehicle' => 'required|numeric',
            'rent_name' => 'required|string',
            'start_rent_date' => 'required',
            'end_rent_date' => 'required',
            'guarante_rent_1' => 'file',
            'guarante_rent_2' => 'file',
            'guarante_rent_3' => 'file',
            'rent_price' => 'required|numeric|min:3',
        ]);

        if ($request->hasFile('guarante_rent_1')) {
            $validated['guarante_rent_1'] = $request->file('guarante_rent_1')->storeAs('guarante-file', 'guarante_1_' . date('YMd_His') . $validated['rent_name']);
            Storage::delete($oldGuarante1);
        } else {
            $validated['guarante_rent_1'] = $oldGuarante1;
        }

        if ($request->hasFile('guarante_rent_2')) {
            $validated['guarante_rent_2'] = $request->file('guarante_rent_2')->storeAs('guarante-file', 'guarante_2_' . date('YMd_His') . $validated['rent_name']);
            Storage::delete($oldGuarante2);
        } else {
            $validated['guarante_rent_2'] = $oldGuarante2;
        }

        if ($request->hasFile('guarante_rent_3')) {
            $validated['guarante_rent_3'] = $request->file('guarante_rent_3')->storeAs('guarante-file', 'guarante_3_' . date('YMd_His') . $validated['rent_name']);
            Storage::delete($oldGuarante3);
        } else {
            $validated['guarante_rent_3'] = $oldGuarante3;
        }

        if ($rental->update($validated)) {
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
    public function destroy($id)
    {
        $rental = Rental::where('id', $id)->first();

        if (!$rental) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        if ($rental->guarante_rent_1 !== null) {
            Storage::delete($rental->guarante_rent_1);
        }

        if ($rental->guarante_rent_2 !== null) {
            Storage::delete($rental->guarante_rent_2);
        }

        if ($rental->guarante_rent_3 !== null) {
            Storage::delete($rental->guarante_rent_3);
        }

        if ($rental->delete()) {
            return True;
        } else {
            return False;
        }
    }
}