<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Perbaiki Token, 
// Pada tabel personal token harusnya 1 user hanya memiliki 1 token.

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'phone_number' => 'required|numeric',
            'address' => 'required|min:8',
            'password' => 'required|min:4|confirmed'
        ]);

        $validated['role'] = 'Member';
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();
        
        if (!$user && !Hash::check($validated['password'], $user->password)) {
            return response(
                [
                    'message' => 'Account not found'
                ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}