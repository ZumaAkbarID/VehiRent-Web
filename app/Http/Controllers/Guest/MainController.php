<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'title' => config('app.name') . ' | Rental Your Best Vehicle',
            'featuredVehicle' => VehicleSpec::with('brand')->where('vehicle_status', 'Available')->inRandomOrder()->limit(6)->get()
        ];

        return view('Guest.main', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About | ' . config('app.name')
        ];

        return view('Guest.about', $data);
    }

    public function services()
    {
        $data = [
            'title' => 'Services | ' . config('app.name')
        ];

        return view('Guest.services', $data);
    }

    public function rental()
    {
        $data = [
            'title' => 'Rental | ' . config('app.name'),
            'vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_status', 'Available')->paginate(10),
            'types' => Type::all()
        ];

        return view('Guest.rental', $data);
    }

    public function queryRental(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/rental');
        }

        $paginate = 10;

        if (request()->filter) {
            $type = Type::where('type_slug', request()->filter)->first();
            return view('Guest.Ajax.main-rental', ['vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->where('id_type', $type->id)->paginate($paginate)]);
        } else if (request()->search) {
            return view('Guest.Ajax.main-rental', ['vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->filter(request(['search']))->paginate($paginate)]);
        }

        return view('Guest.Ajax.main-rental', [
            'vehicles' => VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_status', 'Available')->paginate($paginate)
        ]);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | ' . config('app.name')
        ];

        return view('Guest.contact', $data);
    }
}