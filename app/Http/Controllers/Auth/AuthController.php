<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Auth | ' . config('app.name')
        ];

        return view('Auth.login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Auth | ' . config('app.name')
        ];

        return view('Auth.register', $data);
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'auth' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->auth)->orWhere('phone_number', $request->auth)->first();
        if ($user) {
            $credentials = ['email' => $user->email, 'password' => $request->password];
        } else {
            return redirect()->back()->withInput()->with('error', 'Credentials not match');
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('redirects')
                ->with('success', 'You have Successfully loggedin');
        }

        return redirect()->back()->withInput()->with('error', 'Credentials not match');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone_number' => 'required|numeric|min:6|unique:users,phone_number',
            'address' => 'required|string|min:4',
            'password' => 'required|confirmed|min:4'
        ]);

        $validated['role'] = 'Member';
        $validated['avatar'] = 'user-avatar/default.png';
        $validated['password'] = bcrypt($request->password);
        $userId = User::create($validated)->id;

        $token = sha1(mt_rand(1, 90000) . $userId);
        $userVerify = UserVerify::create([
            'user_id' => $userId,
            'token' => $token,
            'updated_at' => null
        ]);

        FacadesMail::send('Auth.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        if ($userVerify) {
            return redirect('/auth/register')->withInput()->with('success', 'Email verification sent, please check your email');
        } else {
            return redirect('/auth/register')->withInput()->with('error', 'Failed to send Email verification');
        }
    }

    public function logout()
    {
        FacadesSession::flush();
        Auth::logout();

        return redirect('/auth/login')->with('success', 'Logout Successfully');
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = User::find($verifyUser->user_id);

            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
                $message = "Your e-mail is verified. You can now login.";
                return redirect('/auth/login')->with('info', $message);
            } else {
                $message = "Your e-mail is already verified. You can now login.";
                return redirect('/auth/login')->with('info', $message);
            }
        }
        return redirect('/auth/login')->with('error', $message);
    }
}