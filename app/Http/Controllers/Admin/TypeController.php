<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Type | ' . config('app.name')
        ];

        return view('Admin.Type.index', $data);
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
            return redirect()->route('AdminTypes');
        }

        if (request()->filter && request()->filter == 'latest') {
            return view('Admin.Type.Ajax.main-table', ['types' => Type::with(['brand', 'vehicleSpec'])->latest()->filter(request(['search']))->paginate($paginate)]);
        } else if (request()->filter && request()->filter == 'oldest') {
            return view('Admin.Type.Ajax.main-table', ['types' => Type::with(['brand', 'vehicleSpec'])->oldest()->filter(request(['search']))->paginate($paginate)]);
        } else if (request()->filter && request()->filter == 'asc' || request()->filter == 'desc') {
            return view('Admin.Type.Ajax.main-table', ['types' => Type::with(['brand', 'vehicleSpec'])->filter(request(['search', 'filter']))->orderBy('type_name', request()->filter)->paginate($paginate)]);
        }

        return view('Admin.Type.Ajax.main-table', ['types' => Type::with(['brand', 'vehicleSpec'])->filter(request(['search', 'filter']))->orderBy('type_name', 'asc')->paginate($paginate)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Type.Ajax.create-form');
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
            'type_name' => 'required|string|unique:types,type_name'
        ]);

        $validation['type_slug'] = Str::slug($request->type_name);

        Type::create($validation);
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
        return view('Admin.Type.Ajax.edit-form', ['type' => Type::find($id)]);
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
        $validation = $request->validate([
            'id' => 'required',
            'type_name' => 'required|string|unique:types,type_name', $request->id
        ]);

        Type::where('id', $request->id)->update($validation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $type = Type::find($request->id);
        if (is_null($type)) {
            abort(403);
        }
        $type->delete();
    }
}