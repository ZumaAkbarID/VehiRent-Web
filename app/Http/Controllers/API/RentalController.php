<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VehicleSpec::with('type')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!VehicleSpec::find($request->id_vehicle)) {
            return response(['message' => 'Data vehicle was not found.'], 401);
        }

        if (!User::find($request->id_user)) {
            return response(['message' => 'Data user was not found.'], 401);
        }

        $validated = $request->validate([
            'id_vehicle' => 'required|numeric',
            'id_user' => 'required|numeric',
            'start_rent_date' => 'required',
            'end_rent_date' => 'required',
            'guarante_rent_1' => 'required|file',
            'guarante_rent_2' => 'file',
            'guarante_rent_3' => 'file',
            'rent_price' => 'required|numeric|min:3',
        ]);
        $validated['updated_at'] = null;

        if ($request->hasFile('guarante_rent_1')) {
            $validated['guarante_rent_1'] = $request->file('guarante_rent_1')->storeAs('guarante-file', 'guarante_1_' . date('YMd_His') . User::where('id', $validated['id_user'])->first()->name);
        } else {
            return response(['message' => 'The given data was invalid.', 'errors' => ['guarante_rent_1' => ['Failed to upload image.']]], 401);
        }

        if ($request->hasFile('guarante_rent_2')) {
            $validated['guarante_rent_2'] = $request->file('guarante_rent_2')->storeAs('guarante-file', 'guarante_2_' . date('YMd_His') . User::where('id', $validated['id_user'])->first()->name);
        } else {
            $validated['guarante_rent_2'] = null;
        }

        if ($request->hasFile('guarante_rent_3')) {
            $validated['guarante_rent_3'] = $request->file('guarante_rent_3')->storeAs('guarante-file', 'guarante_3_' . date('YMd_His') . User::where('id', $validated['id_user'])->first()->name);
        } else {
            $validated['guarante_rent_3'] = null;
        }

        if (Rental::create($validated)) {
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
            'id_user' => 'required|numeric',
            'start_rent_date' => 'required',
            'end_rent_date' => 'required',
            'guarante_rent_1' => 'file',
            'guarante_rent_2' => 'file',
            'guarante_rent_3' => 'file',
            'rent_price' => 'required|numeric|min:3',
        ]);

        if ($request->hasFile('guarante_rent_1')) {
            $validated['guarante_rent_1'] = $request->file('guarante_rent_1')->storeAs('guarante-file', 'guarante_1_' . date('YMd_His') . User::where('id', $validated['id_user'])->first()->name);
            Storage::delete($oldGuarante1);
        } else {
            $validated['guarante_rent_1'] = $oldGuarante1;
        }

        if ($request->hasFile('guarante_rent_2')) {
            $validated['guarante_rent_2'] = $request->file('guarante_rent_2')->storeAs('guarante-file', 'guarante_2_' . date('YMd_His') . User::where('id', $validated['id_user'])->first()->name);
            Storage::delete($oldGuarante2);
        } else {
            $validated['guarante_rent_2'] = $oldGuarante2;
        }

        if ($request->hasFile('guarante_rent_3')) {
            $validated['guarante_rent_3'] = $request->file('guarante_rent_3')->storeAs('guarante-file', 'guarante_3_' . date('YMd_His') . User::where('id', $validated['id_user'])->first()->name);
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