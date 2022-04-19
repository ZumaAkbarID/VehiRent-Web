<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Rental;
use App\Models\Type;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isEmailVerified', 'isAdmin']);
    }

    public function index()
    {
        // $tipe = Type::with(['brand', 'vehicleSpec'])->get(); // Car, Motor
        // $brand = $tipe->brand; // Di Loop untuk mendapatkan Brand Dari Tipe tersebut
        // $vehicle = $tipe->vehicleSpec; // Di loop untuk mendapatkan vehicle
        // Kemudian vehicle di $tipe disamakan menggunakan if, jika sama i +1

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.quotable.io/random'); // Free quotes API
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $vehicleSpec = VehicleSpec::with(['rental', 'brand'])->get();
        $allRental = Rental::with(['vehicleSpec']);
        $brands = Brand::with(['type'])->get();

        $data = [
            'title' => 'Admin Dashboard | ' . config('app.name'),
            'user' => auth()->user(),
            'rentalSuccess' => Rental::where('status', 'Completed')->count(),
            'rentalOngoing' => Rental::where('status', '!=', 'Completed')->count(),
            'allRental' => $allRental,
            'brand' => $brands,
            'vehicleSpec' => $vehicleSpec,
            'quote' => json_decode($output, true),
            'AdminDashboard' => true,
            'topCustomer' => Rental::select('user_id', DB::raw('COUNT(id) as counter'))->groupBy('user_id')->orderBy(DB::raw('COUNT(id)', 'DESC'))->take(5)->get()
        ];
        // dd(Rental::select('user_id', DB::raw('COUNT(id) as counter'))->groupBy('user_id')->orderBy(DB::raw('COUNT(id)', 'DESC'))->take(5)->get());

        return view('Admin.dashboard', $data);
    }
}
