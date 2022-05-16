<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->limit) {
            return Brand::with(['type', 'vehicleSpec'])->limit(request()->limit)->get();
        } else {
            return Brand::with(['type', 'vehicleSpec'])->get();
        }
    }

    /**
     * Store a newly created resource in storage. a
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string|unique:brands',
            'brand_image' => 'required|file|image|mimes:png|max:2048'
        ]);
        $validated['updated_at'] = null;

        if ($request->hasFile('brand_image')) {
            $validated['brand_image'] = $request->file('brand_image')->store('brand-logo');
        } else {
            return response(['message' => 'The given data was invalid.', 'errors' => ['brand_image' => ['Failed to upload image.']]], 401);
        }

        if (Brand::create($validated)) {
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
        $brand = Brand::where('brand_slug', $id)->with(['type', 'vehicleSpec'])->first();

        if (!$brand) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        return $brand;
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
        $brand = Brand::where('id', $id);
        $oldImagePath = $brand->first()->brand_image;

        if (!$brand->first()) {
            return response(['message' => 'The given data was not found.'], 401);
        } else if (Brand::where('brand_name', $request->brand_name)->first()) {
            return response(['message' => 'The given data was invalid.', 'errors' => ['brand_name' => ['The brand name has already been taken.']]], 401);
        }

        $validated = $request->validate([
            'brand_name' => 'required|string',
            'brand_image' => 'file|image|mimes:png|max:2048'
        ]);

        if ($request->hasFile('brand_image')) {
            $validated['brand_image'] = $request->file('brand_image')->store('brand-logo');
            Storage::delete($oldImagePath);
        } else {
            $validated['brand_image'] = $oldImagePath;
        }

        if ($brand->update($validated)) {
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
        $brand = Brand::where('id', $id)->first();

        if (!$brand) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        if ($brand->brand_image !== 'default.png') {
            Storage::delete($brand->brand_image);
        }

        if ($brand->delete()) {
            return True;
        } else {
            return False;
        }
    }
}