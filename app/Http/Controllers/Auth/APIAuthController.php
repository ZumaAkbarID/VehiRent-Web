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
            'email' => 'required|email:dns|unique:users,email',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'address' => 'required|min:8',
            'password' => 'required|min:4|confirmed'
        ]);

        $validated['role'] = 'Member';
        $validated['avatar'] = 'user-avatar/default.png';
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $token = $user->createToken('authToken')->plainTextToken;

        $token = sha1(mt_rand(1, 90000) . $user->id);
        $userVerify = UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
            'description' => 'Email Verification',
            'status' => 'Available',
            'updated_at' => null
        ]);

        Mail::send('Auth.Email.emailVerificationEmail', ['token' => $token, 'isMobile' => 1], function ($message) use ($request) {
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

        if (!$user->email_verified_at) {
            return response(['message' => 'You need to confirm your account. We have sent you an activation code, please check your email. check spam also'], 401);
        }

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

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        if ($verifyUser->status == 'Expire') {
            return response(['status' => 'Failed', 'message' => 'Token Expired'], 401);
        }

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $verifyUser->update(['status' => 'Expire']);
            $user = User::find($verifyUser->user_id);

            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
                $message = "Your e-mail is verified. You can now login.";
                return response(['status' => 'Success', 'message' => $message]);
            } else {
                $message = "Your e-mail is already verified. You can now login.";
                return response(['status' => 'Info', 'message' => $message]);
            }
        }
        return response(['status' => 'Failed', 'message' => $message], 401);
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response(['status' => 'Failed', 'Invalid Credentials'], 401);
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

            Mail::send('Auth.Email.emailVerificationEmail', ['token' => $token, 'isMobile' => 1], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });

            return response(['status' => 'Failed', 'message' => 'You need to verify your email first. A verification email has been sent to ' . $user->email]);
        }

        $token = sha1(mt_rand(1, 90000) . $user->id);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
            'description' => 'Reset Password Attempt',
            'status' => 'Available',
            'updated_at' => null
        ]);

        Mail::send('Auth.Email.emailResetPasswordEmail', ['token' => $token, 'isMobile' => 1], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Resset Password Mail');
        });

        return redirect()->back()->with('success', 'A password reset confirmation has been sent to your email');
    }

    public function resetPasswordCheck($token)
    {
        $verifyUser = UserVerify::where('token', $token)->where('status', '!=', 'Available')->first();

        $message = 'Sorry your token cannot be identified.';

        if (!is_null($verifyUser)) {
            return response(['status' => 'Success', 'message' => 'Create new password']);
        }
        return response(['status' => 'Failed', 'message' => $message], 403);
    }

    public function savePassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $verifyUser = UserVerify::where('token', $token)->first();

        if ($verifyUser->status !== 'Expire') {
            $updatePassword = User::where('id', $verifyUser->user_id)->update(['password' => Hash::make($request->password)]);
            if ($updatePassword) {
                $verifyUser->update(['status' => 'Expire',]);
                return response(['status' => 'Success', 'message' => 'Your password has been successfully updated']);
            }
            return response(['status' => 'Failed', 'message' => 'Your password failed to update'], 500);
        }
        return response(['status' => 'Failed', 'message' => 'Token Expired'], 403);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Successfully logout'], 200);
    }
}