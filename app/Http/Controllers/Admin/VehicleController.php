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
        return view('Admin.Vehicle.Ajax.create-form', ['types' => Type::all()]);
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
            'type_id' => 'required',
            'brand_name' => 'required|string|unique:brands,brand_name',
            'upload' => 'required|image|mimes:jpg,png,gif,jpeg|max:2048'
        ]);

        if ($request->hasFile('upload')) {
            $validation['brand_image'] = $request->file('upload')->storeAs('brand-logo', Str::slug($validation['brand_name']));
        }
        $validation['brand_slug'] = Str::slug($request->brand_name);

        Brand::create($validation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Admin.Brand.Ajax.edit-form', ['brand' => Brand::find($id), 'types' => Type::all()]);
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
        if (Brand::where('brand_name', $request->brand_name)->where('id', '!=', $request->brand_id)->first()) {
            abort(403);
        }

        $validation = $request->validate([
            'brand_id' => 'required',
            'type_id' => 'required',
            'brand_name' => 'required|string'
        ]);
        $validation['brand_slug'] = Str::slug($request->brand_name);

        if ($request->hasFile('upload')) {
            $request->validate(['upload' => 'required|image|mimes:jpg,png,gif,jpeg|max:2048']);
            $validation['brand_image'] = $request->file('upload')->storeAs('brand-logo', $validation['brand_name']);
            Storage::delete($request->oldImage);
        } else {
            $validation['brand_image'] = $request->oldImage;
        }

        $data = [
            'type_id' => $validation['type_id'],
            'brand_name' => $validation['brand_name'],
            'brand_slug' => $validation['brand_slug'],
            'brand_image' => $validation['brand_image'],
        ];

        Brand::where('id', $request->brand_id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand = Brand::find($request->brand_id);
        if (is_null($brand)) {
            abort(403);
        }
        Storage::delete($brand->brand_image);
        $brand->delete();
    }
}