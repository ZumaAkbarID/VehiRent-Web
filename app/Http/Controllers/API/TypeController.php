<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Brand;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->limit) {
            return Type::with(['brand', 'VehicleSpec'])->limit(request()->limit)->get();
        } else {
            return Type::with(['brand', 'VehicleSpec'])->get();
        }
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
            'brand_id' => 'required',
            'type_name' => 'required|string|unique:types'
        ]);

        if (!Brand::find($request->brand_id)) {
            return response(['message' => 'Data Brand was not found.'], 401);
        }

        $validated['updated_at'] = null;

        if (Type::create($validated)) {
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
        $type = Type::where('type_slug', $id)->with(['brand', 'VehicleSpec'])->first();

        if (!$type) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        return $type;
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
        if (!Type::find($id)) {
            return response(['message' => 'The given data was not found.'], 401);
        } else if (Type::where('type_name', $request->type_name)->first()) {
            return response(['message' => 'The given data was invalid.', 'errors' => ['type_name' => ['The type name has already been taken.']]]);
        }

        $validated = $request->validate([
            'brand_id' => 'required',
            'type_name' => 'required|string'
        ]);

        if (!Brand::find($request->brand_id)) {
            return response(['message' => 'Data brand was not found.'], 401);
        }

        if (Type::where('id', $id)->update($validated)) {
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
        $type = Type::where('id', $id)->first();

        if (!$type) {
            return response(['message' => 'The given data was not found.'], 401);
        }

        if ($type->delete()) {
            return True;
        } else {
            return False;
        }
    }
}