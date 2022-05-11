<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleSpecsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->limit) {
            return VehicleSpec::with('type')->limit(request()->limit)->get();
        } else {
            return VehicleSpec::with('type')->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Type::find($request->id_type)) {
            return response(['message' => 'Data type was not found.'], 401);
        }

        $validated = $request->validate([
            'id_type' => 'required|numeric',
            'vehicle_name' => 'required|string|unique:vehicle_specs',
            'vehicle_image' => 'required|file|image|mimes:png,jpg|max:2048',
            'vehicle_year' => 'required|numeric|min:4',
            'vehicle_color' => 'required|string',
            'vehicle_seats' => 'required|numeric',
            'vehicle_status' => 'required',
            'rent_price' => 'required|numeric|min:3',
            'vehicle_description' => 'required|string',
        ]);
        $validated['updated_at'] = null;

        if ($request->hasFile('vehicle_image')) {
            $validated['vehicle_image'] = $request->file('vehicle_image')->store('vehicle-image');
        } else {
            return response(['message' => 'The given data was invalid.', 'errors' => ['vehicle_image' => ['Failed to upload image.']]], 401);
        }

        if (VehicleSpec::create($validated)) {
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
        $vehicle = VehicleSpec::where('id', $id)->with('type')->first();

        if (!$vehicle) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        return $vehicle;
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
        $vehicle = VehicleSpec::where('id', $id);
        $oldImagePath = $vehicle->first()->vehicle_image;

        if (!$vehicle->first()) {
            return response(['message' => 'The given data was not found.'], 401);
        } else if (VehicleSpec::where('vehicle_name', $request->vehicle_name)->first()) {
            return response(['message' => 'The given data was invalid.', 'errors' => ['vehicle_name' => ['The brand name has already been taken.']]], 401);
        } else if (!Type::find($request->id_type)) {
            return response(['message' => 'Data type was not found.'], 401);
        }

        $validated = $request->validate([
            'id_type' => 'required|numeric',
            'vehicle_name' => 'required|string|unique:vehicle_specs',
            'vehicle_image' => 'file|image|mimes:png,jpg|max:2048',
            'vehicle_year' => 'required|numeric|min:4',
            'vehicle_color' => 'required|string',
            'vehicle_seats' => 'required|numeric',
            'vehicle_status' => 'required',
            'rent_price' => 'required|numeric|min:3',
            'vehicle_description' => 'required|string',
        ]);

        if ($request->hasFile('vehicle_image')) {
            $validated['vehicle_image'] = $request->file('vehicle_image')->store('vehicle-image');
            Storage::delete($oldImagePath);
        } else {
            $validated['vehicle_image'] = $oldImagePath;
        }

        if ($vehicle->update($validated)) {
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
        $vehicle = VehicleSpec::where('id', $id)->first();

        if (!$vehicle) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        if ($vehicle->vehicle_image !== 'default.png') {
            Storage::delete($vehicle->vehicle_image);
        }

        if ($vehicle->delete()) {
            return True;
        } else {
            return False;
        }
    }
}