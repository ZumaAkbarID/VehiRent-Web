<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        $token = mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9);

        $userVerify = UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
            'description' => 'Mobile Email Verification',
            'status' => 'Available',
            'updated_at' => null
        ]);

        Mail::send('Auth.Email.emailVerificationEmail', ['token' => $token, 'isMobile' => 1, 'client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
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

    public function verifyAccount()
    {
        $email = request()->email;
        $token = request()->token;

        $verifyUser = UserVerify::where('token', $token)->where('user_id', User::where('email', $email)->first()->id)->first();

        if ($verifyUser->status == 'Expire') {
            return response(['status' => 'Failed', 'message' => 'Token Expired'], 401);
        }

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $verifyUser->update(['token' => time(), 'status' => 'Expire']);
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
            return response(['status' => 'Failed', 'message' => 'Invalid Credentials'], 401);
        }

        if (is_null($user->email_verified_at)) {

            $token = mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9);
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token,
                'description' => 'Mobile Email verification',
                'status' => 'Available',
                'updated_at' => null
            ]);

            Mail::send('Auth.Email.emailVerificationEmail', ['token' => $token, 'isMobile' => 1, 'client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Mobile Change Password Verification');
            });

            return response(['status' => 'Failed', 'message' => 'You need to verify your email first. A verification email has been sent to ' . $user->email]);
        }

        $token = mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9) . mt_rand(1, 9);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
            'description' => 'Reset Password Attempt',
            'status' => 'Available',
            'updated_at' => null
        ]);

        Mail::send('Auth.Email.emailResetPasswordEmail', ['token' => $token, 'isMobile' => 1, 'client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Mobile Change Password Verification');
        });

        return response(['status' => 'Success', 'message' => 'A OTP code has been sent to your email']);
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
                $verifyUser->update(['token' => time(), 'status' => 'Expire',]);
                return response(['status' => 'Success', 'message' => 'Your password has been successfully updated']);
            }
            return response(['status' => 'Failed', 'message' => 'Your password failed to update'], 500);
        }
        return response(['status' => 'Failed', 'message' => 'Token Expired'], 403);
    }

    public function saveKYC(Request $request)
    {
        if (auth()->user()->kyc !== null) {
            return response([
                'status' => 'Failed',
                'message' => 'Your account is verified'
            ], 403);
        }

        $this->validate($request, [
            'ktp' => 'required|file|image|mimes:jpg,png,jpeg,pdf'
        ]);

        $kycName = $request->file('ktp')->storeAs('user-kyc', Str::slug('kyc ' . auth()->user()->name . ' ' . time()) . '.' . $request->file('ktp')->getClientOriginalExtension());
        if (User::find(auth()->user()->id)->update(
            ['kyc' => $kycName]
        )) {
            return response([
                'status' => 'Success',
                'message' => 'Success upload personal information'
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Successfully logout'], 200);
    }
}