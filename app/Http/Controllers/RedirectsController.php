<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isEmailVerified']);
    }

    public function redirect()
    {
        if (auth()->user()->role == 'Admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}