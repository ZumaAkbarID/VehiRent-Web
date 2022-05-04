<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class APIAuthController extends Controller
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
        $validated['avatar'] = 'user-avatar/default.png';
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $token = $user->createToken('authToken')->plainTextToken;

        $token = sha1(mt_rand(1, 90000) . $user->id) . '?redirect=mobile';
        $userVerify = UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
            'description' => 'Email Verification',
            'status' => 'Available',
            'updated_at' => null
        ]);

        Mail::send('Auth.Email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        if ($userVerify) {
            $response = [
                'message' => 'Email verification has been sent to your mail account'
            ];
            $status = 200;
        } else {
            $response = [
                'message' => 'Failed to sent email verification to your mail account'
            ];
            $status = 401;
        }

        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        return response($response, $status);
    }

    public function token(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response(
                [
                    'message' => 'Account not found'
                ],
                401
            );
        }

        $user->tokens()->delete();
        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Successfully logout'], 200);
    }
}