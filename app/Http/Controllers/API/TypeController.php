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
        return Type::with('brand')->get();
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
            return "Brand Not Found";
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
        $type = Type::where('id', $id)->with('brand')->first();

        if (!$type) {
            return "Not Found";
        }

        return $type;
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
        if (!Type::find($id)) {
            return "Not Found";
        } else if (Type::where('type_name', $request->type_name)->first()) {
            return response(['message' => 'The given data was invalid.', 'errors' => ['type_name' => ['The type name has already been taken.']]]);
        }

        $validated = $request->validate([
            'brand_id' => 'required',
            'type_name' => 'required|string'
        ]);

        if (!Brand::find($request->brand_id)) {
            return "Brand Not Found";
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
            return "Not Found";
        }

        if ($type->delete()) {
            return True;
        } else {
            return False;
        }
    }
}