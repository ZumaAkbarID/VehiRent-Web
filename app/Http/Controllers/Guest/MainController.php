<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'title' => config('app.name') . ' | Rental Your Best Vehicle'
        ];

        return view('guest.main', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About | ' . config('app.name')
        ];

        return view('guest.about', $data);
    }

    public function services()
    {
        $data = [
            'title' => 'Services | ' . config('app.name')
        ];

        return view('guest.services', $data);
    }

    public function rental()
    {
        $data = [
            'title' => 'Rental | ' . config('app.name')
        ];

        return view('guest.rental', $data);
    }

    public function vehicleSingle()
    {
        $data = [
            'title' => 'Single Vehicle | ' . config('app.name')
        ];

        return view('guest.vehicle-single', $data);
    }

    public function blog()
    {
        $data = [
            'title' => 'Blog | ' . config('app.name')
        ];

        return view('guest.blog', $data);
    }

    public function singleBlog()
    {
        $data = [
            'title' => 'Single Blog | ' . config('app.name')
        ];

        return view('guest.blog-single', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | ' . config('app.name')
        ];

        return view('guest.contact', $data);
    }
}