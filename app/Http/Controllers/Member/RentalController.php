<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\VehicleSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RentalController extends Controller
{

    public function vehicleSingle($slug)
    {
        $vehicle = VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_slug', $slug)->where('vehicle_status', 'Available');

        if (!$vehicle->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not found!');
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not available!');
        }

        $data = [
            'title' => $vehicle->first()->vehicle_name . ' | ' . config('app.name'),
            'vehicle' => $vehicle->first(),
            'related' => VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_status', 'Available')->inRandomOrder()->limit(3)->get()
        ];

        return view('Guest.vehicle-single', $data);
    }

    public function rentalForm($slug)
    {
        $vehicle = VehicleSpec::with(['type', 'rental', 'brand'])->where('vehicle_slug', $slug);

        if (!$vehicle->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not found!');
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not available!');
        }

        if (auth()->user()->role == 'Admin') {
            return redirect()->to(route('vehicleSingle', $slug))->with('error', 'You are Admin!');
        }

        $data = [
            'title' => $vehicle->first()->vehicle_name . ' | ' . config('app.name'),
            'vehicle' => $vehicle->first(),
        ];

        return view('Guest.rental-form', $data);
    }

    public function createInvoice(Request $request)
    {
        if (auth()->user()->kyc == null) {
            return redirect()->to(route('profile'))->with('error', 'You need to identity verify');
        }

        $vehicle = VehicleSpec::with(['brand', 'type'])->where('id', $request->id_vehicle);

        if (!$vehicle->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not found!');
        } else if (!$vehicle->where('vehicle_status', 'Available')->first()) {
            return redirect()->to('/rental')->with('error', 'Vehicle not available!');
        }

        $bookList = Booked::where('id_vehicle', $request->id_vehicle)->where('status_book', 'Booked')->get();
        if (sizeof($bookList) !== 0) {
            foreach ($bookList as $book) {
                if ($book->start_book_date <= $request->start_rent_date && $book->end_book_date >= $request->end_rent_date) {
                    return redirect()->back()->with('info', "This Vehicle has been booked for " . date('D d M Y', strtotime($book->start_book_date)) . " until " . date('D d M Y', strtotime($book->end_book_date)) . ". You can search other day or vehicle");
                } else if ($request->end_rent_date == $book->end_book_date || $request->start_rent_date == $book->start_book_date || $request->end_rent_date == $book->start_book_date || $request->start_rent_date == $book->end_book_date) {
                    return redirect()->back()->with('info', "This Vehicle has been booked for " . date('D d M Y', strtotime($book->start_book_date)) . " until " . date('D d M Y', strtotime($book->end_book_date)) . ". You can search other day or vehicle");
                } else if ($book->start_book_date < $request->start_rent_date && $book->end_book_date > $request->start_rent_date) {
                    return redirect()->back()->with('info', "This Vehicle has been booked for " . date('D d M Y', strtotime($book->start_book_date)) . " until " . date('D d M Y', strtotime($book->end_book_date)) . ". You can search other day or vehicle");
                } else if ($book->start_book_date < $request->end_rent_date && $book->end_book_date > $request->end_rent_date) {
                    return redirect()->back()->with('info', "This Vehicle has been booked for " . date('D d M Y', strtotime($book->start_book_date)) . " until " . date('D d M Y', strtotime($book->end_book_date)) . ". You can search other day or vehicle");
                }
            }
        }

        // Create Code
        $lastMaxCode = Rental::all()->max('transaction_code');
        $transaction_code = (int) substr($lastMaxCode, 3, 9);
        $transaction_code++;
        $trxCode = 'TRX' . sprintf('%09s', $transaction_code);

        $query = new Rental();
        $query->transaction_code = $trxCode;
        $query->user_id = auth()->user()->id;
        $query->id_vehicle = $request->id_vehicle;
        $query->start_rent_date = $request->start_rent_date;
        $query->end_rent_date = $request->end_rent_date;

        if (date('Y-m-d') == $request->start_rent_date) {
            $isBooked = false;
        } else if (strtotime(date('Y-m-d')) < strtotime($request->start_rent_date)) {
            $isBooked = true;
        } else {
            return redirect()->back()->with('error', "Rent date must be highter than now!");
        }

        if ($isBooked) {
            $query->status = 'Booked';
        } else {
            $query->status = 'Not Picked';
            $vehicle->where('vehicle_status', 'Available')->update(['vehicle_status' => 'Not Available']);
        }

        if ($request->hasFile('guarante_rent_1')) {
            $query->guarante_rent_1 = $request->file('guarante_rent_1')->storeAs('guarante-ktp', 'KTP-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth()->user()->name) . '.' . $request->file('guarante_rent_1')->getClientOriginalExtension());
        } else if ($request->hasFile('guarante_rent_2')) {
            $query->guarante_rent_2 = $request->file('guarante_rent_2')->storeAs('guarante-sim', 'SIM-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth()->user()->name) . '.' . $request->file('guarante_rent_2')->getClientOriginalExtension());
        } else if ($request->hasFile('guarante_rent_3')) {
            $query->guarante_rent_3 = $request->file('guarante_rent_3')->storeAs('guarante-kk', 'KK-' . date('d-m-y-h-i-s') . '-' . Str::slug(auth()->user()->name) . '.' . $request->file('guarante_rent_3')->getClientOriginalExtension());
        }
        $query->rent_price = $request->totalAmount;
        $query->save();

        if ($isBooked) {
            Booked::create([
                'id_rental' => $query->id,
                'id_vehicle' => $request->id_vehicle,
                'id_user' => auth()->user()->id,
                'start_book_date' => $request->start_rent_date,
                'end_book_date' => $request->end_rent_date,
                'status_book' => 'Booked',
            ]);
        }

        $startDate = strtotime($request->start_rent_date);
        $endDate = strtotime($request->end_rent_date);

        $timeDiff = abs($startDate - $endDate);
        $numberDays = $timeDiff / 86400;
        $numberDays = intval($numberDays);

        Mail::send('Email.emailInvoice', [
            'client_ip_address' => $request->getClientIp(),
            'transaction_code' => $trxCode,
            'status' => 'Unpaid',
            'vehicle' => $vehicle->first(),
            'numberDays' => $numberDays,
            'user' => auth()->user(),
            'rental' => $query
        ], function ($message) use ($request) {
            $message->to(auth()->user()->email);
            $message->subject('Rental Invoice');
        });

        // return redirect()->to(route('viewInvoice', $trxCode));
        return redirect()->to(route('historyDetail', $trxCode));
    }

    public function viewInvoice($trxCode)
    {
        $rental = Rental::with(['vehicleSpec', 'payment'])->where('transaction_code', $trxCode)->first();

        if (isset($rental->payment->transaction_code)) {
            $status = 'Paid';
        } else {
            $status = 'Unpaid';
        }

        $startDate = strtotime($rental->start_rent_date);
        $endDate = strtotime($rental->end_rent_date);

        $timeDiff = abs($startDate - $endDate);
        $numberDays = $timeDiff / 86400;
        $numberDays = intval($numberDays);

        $data = [
            'transaction_code' => $trxCode,
            'rental' => $rental,
            'status' => $status,
            'vehicle' => $rental->vehicleSpec,
            'numberDays' => $numberDays
        ];

        return view('Guest.invoice', $data);
    }
}