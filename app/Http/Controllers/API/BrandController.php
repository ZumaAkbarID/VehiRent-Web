<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Brand::with('type')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // none
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string|unique:brands'
        ]);
        $validated['updated_at'] = null;

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
        $brand = Brand::where('id', $id)->with('type')->first();

        if (!$brand) {
            return "Not Found";
        }

        return $brand;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // none
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
        $brand = Brand::where('id', $id)->first();

        if (!$brand) {
            return "Not Found";
        } else if (Brand::where('brand_name', $request->brand_name)->first()) {
            return response(['message' => 'The given data was invalid.', 'errors' => ['brand_name' => ['The brand name has already been taken.']]]);
        }

        $validated = $request->validate([
            'brand_name' => 'required|string'
        ]);

        if (Brand::where('id', $id)->update($validated)) {
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
            return "Not Found";
        }

        if ($brand->delete()) {
            return True;
        } else {
            return False;
        }
    }
}