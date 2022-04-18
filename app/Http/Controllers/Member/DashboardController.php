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
        $data = [
            'title' => 'Dashboard | ' . config('app.name'),
            'user' => auth()->user()
        ];

        return view('Member.dashboard', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile | ' . config('app.name'),
            'user' => auth()->user()
        ];

        return view('Member.profile', $data);
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