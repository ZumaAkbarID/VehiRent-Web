<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Login | ' . config('app.name')
        ];

        return view('Auth.login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register | ' . config('app.name')
        ];

        return view('Auth.register', $data);
    }

    public function resetPassword()
    {
        $data = [
            'title' => 'Reset Password | ' . config('app.name')
        ];

        return view('Auth.reset-password', $data);
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
            'description' => 'Email Verification',
            'status' => 'Available',
            'updated_at' => null
        ]);

        FacadesMail::send('Auth.Email.emailVerificationEmail', ['token' => $token, 'client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        if ($userVerify) {
            return redirect('/auth/login')->withInput()->with('success', 'Email verification sent, please check your email');
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

        if ($verifyUser->status == 'Expire') {
            return redirect('/auth/login')->with('error', 'Token Expired');
        }

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $verifyUser->update(['status' => 'Expire']);
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

    public function resetPasswordProcess(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }

        if (is_null($user->email_verified_at)) {

            $token = sha1(mt_rand(1, 90000) . $user->id);
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token,
                'description' => 'Email Verification',
                'status' => 'Available',
                'updated_at' => null
            ]);

            FacadesMail::send('Auth.Email.emailVerificationEmail', ['token' => $token, 'client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });

            return redirect()->back()->with('error', 'You need to verify your email first. A verification email has been sent to ' . $user->email);
        }

        $token = sha1(mt_rand(1, 90000) . $user->id);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
            'description' => 'Reset Password Attempt',
            'status' => 'Available',
            'updated_at' => null
        ]);

        FacadesMail::send('Auth.Email.emailResetPasswordEmail', ['token' => $token, 'client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Resset Password Mail');
        });

        return redirect()->back()->with('success', 'A password reset confirmation has been sent to your email');
    }

    public function verifyResetPassword($token)
    {
        $verifyUser = UserVerify::where('token', $token)->where('status', '!=', 'Available')->first();

        $message = 'Sorry your token cannot be identified.';

        if (!is_null($verifyUser)) {
            $data = [
                'title' => 'Create New Password',
                'token' => $token
            ];
            return view('Auth.create-password', $data);
        }
        return redirect('/auth/login')->with('error', $message);
    }

    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $verifyUser = UserVerify::where('token', $request->tkn)->first();

        if ($verifyUser->status !== 'Expire') {
            $updatePassword = User::where('id', $verifyUser->user_id)->update(['password' => Hash::make($request->password)]);
            if ($updatePassword) {
                $verifyUser->update(['status' => 'Expire',]);
                return redirect('/auth/login')->with('success', 'Your password has been successfully updated');
            }
            return redirect('/auth/login')->with('error', 'Your password failed to update');
        }
        return redirect('/auth/login')->with('error', 'Token Expired');
    }
}