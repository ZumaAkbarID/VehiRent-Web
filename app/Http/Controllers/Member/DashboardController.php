<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Rental;
use App\Models\Type;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isEmailVerified', 'isMember']);
    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.quotable.io/random'); // Free quotes API
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $data = [
            'title' => 'Dashboard | ' . config('app.name'),
            'user' => auth()->user(),
            'rentalSuccess' => Rental::where('user_id', auth()->user()->id)->where('status', 'Completed')->count(),
            'rentalOngoing' => Rental::where('user_id', auth()->user()->id)->where('status', '!=', 'Completed')->count(),
            'quote' => json_decode($output, true)
        ];

        return view('Member.dashboard', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'History | ' . config('app.name'),
            'user' => auth()->user(),
            'transaction' => Rental::where('user_id', auth()->user()->id)->with(['vehicleSpec', 'payment'])->get()
        ];

        return view('Member.history', $data);
    }

    public function historyDetail($transaction_code)
    {
        $transaction = Rental::where('transaction_code', $transaction_code)->with(['vehicleSpec', 'payment'])->first();

        if ($transaction->user_id !== auth()->user()->id) {
            return redirect('/history');
        }

        $vehicleSpec = VehicleSpec::where('id', $transaction->id_vehicle)->with('type')->first();

        $data = [
            'title' => $transaction_code . ' | ' . config('app.name'),
            'user' => auth()->user(),
            'transaction' => $transaction,
            'vehicle' => $vehicleSpec,
            'brand' => Brand::where('id', $vehicleSpec->id_brand)->with('type')->first()
        ];

        return view('Member.history-single', $data);
    }
}