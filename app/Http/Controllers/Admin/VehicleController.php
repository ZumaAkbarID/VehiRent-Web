<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Type;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Vehicle | ' . config('app.name')
        ];

        return view('Admin.Vehicle.index', $data);
    }

    /**
     * Fetch a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $paginate = 10;

        if (!request()->ajax()) {
            return redirect()->route('AdminVehicles');
        }

        if (request()->filter && request()->filter == 'latest') {
            return view('Admin.Vehicle.Ajax.main-table', ['vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->latest()->filter(request(['search']))->paginate($paginate)]);
        } else if (request()->filter && request()->filter == 'oldest') {
            return view('Admin.Vehicle.Ajax.main-table', ['vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->oldest()->filter(request(['search']))->paginate($paginate)]);
        } else if (request()->filter && request()->filter == 'asc' || request()->filter == 'desc') {
            return view('Admin.Vehicle.Ajax.main-table', ['vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->filter(request(['search']))->orderBy('vehicle_name', request()->filter)->paginate($paginate)]);
        }

        return view('Admin.Vehicle.Ajax.main-table', ['vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->filter(request(['search']))->orderBy('vehicle_name', 'asc')->paginate($paginate)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Vehicle.Ajax.create-form', ['types' => Type::all(), 'brands' => Brand::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'brand_id' => 'required',
            'vehicle_name' => 'required|string',
            'number_plate' => 'required|string|unique:vehicle_specs,number_plate',
            'vehicle_year' => 'required|numeric',
            'vehicle_color' => 'required|string',
            'vehicle_seats' => 'required|numeric',
            'rent_price' => 'required|numeric',
            'vehicle_description' => 'required',
            'upload' => 'required|image|mimes:jpg,png,gif,jpeg|max:2048'
        ]);

        $validation['id_type'] = Brand::with('type')->where('id', $request->brand_id)->first()->type->id;
        $validation['id_brand'] = $validation['brand_id'];
        $validation['vehicle_slug'] = Str::slug($validation['vehicle_name']);
        $validation['vehicle_status'] = 'Available';

        if ($request->hasFile('upload')) {
            $validation['vehicle_image'] = $request->file('upload')->storeAs('vehicle-image', $validation['vehicle_slug'] . Str::slug('-' . $request->number_plate));
        }

        VehicleSpec::create($validation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = VehicleSpec::find($id);
        return view('Admin.Vehicle.Ajax.view-detail', [
            'vehicle' => $vehicle,
            'brand' => Brand::with('type')->where('id', $vehicle->id_brand)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Admin.Vehicle.Ajax.edit-form', ['brands' => Brand::all(), 'types' => Type::all(), 'vehicle' => VehicleSpec::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (VehicleSpec::where('number_plate', $request->number_plate)->where('id', '!=', $request->vehicle_id)->first()) {
            abort(403);
        }

        $validation = $request->validate([
            'vehicle_id' => 'required',
            'oldImage' => 'required',
            'brand_id' => 'required',
            'vehicle_name' => 'required|string',
            'number_plate' => 'required|string',
            'vehicle_year' => 'required|numeric',
            'vehicle_color' => 'required|string',
            'vehicle_seats' => 'required|numeric',
            'rent_price' => 'required|numeric',
            'vehicle_description' => 'required',
            'vehicle_status' => 'required'
        ]);

        $validation['id_type'] = Brand::with('type')->where('id', $request->brand_id)->first()->type->id;
        $validation['id_brand'] = $validation['brand_id'];
        $validation['vehicle_slug'] = Str::slug($validation['vehicle_name']);

        if ($request->hasFile('upload')) {
            $request->validate(['upload' => 'required|image|mimes:jpg,png,gif,jpeg|max:2048']);
            if (Storage::exists($request->oldImage)) {
                Storage::delete($request->oldImage);
            }
            $validation['vehicle_image'] = $request->file('upload')->storeAs('vehicle-image', $validation['vehicle_slug'] . Str::slug('-' . $request->number_plate));
        } else {
            $validation['vehicle_image'] = $request->oldImage;
        }

        $data = [
            'id_type' => $validation['id_type'],
            'id_brand' => $validation['id_brand'],
            'vehicle_name' => $validation['vehicle_name'],
            'vehicle_slug' => $validation['vehicle_slug'],
            'vehicle_image' => $validation['vehicle_image'],
            'number_plate' => $validation['number_plate'],
            'vehicle_year' => $validation['vehicle_year'],
            'vehicle_color' => $validation['vehicle_color'],
            'vehicle_seats' => $validation['vehicle_seats'],
            'rent_price' => $validation['rent_price'],
            'vehicle_description' => $validation['vehicle_description'],
            'vehicle_status' => $validation['vehicle_status'],
        ];

        VehicleSpec::where('id', $request->vehicle_id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vehicle = VehicleSpec::find($request->vehicle_id);
        if (is_null($vehicle)) {
            abort(403);
        }
        Storage::delete($vehicle->vehicle_image);
        $vehicle->delete();
    }
}