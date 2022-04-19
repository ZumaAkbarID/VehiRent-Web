<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function saveProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email:rfc,dns|unique:users,email,' . auth()->user()->id,
            'phone_number' => 'required|numeric|min:6|unique:users,phone_number,' . auth()->user()->id,
            'address' => 'required|string|min:8'
        ]);

        if ($request->hasFile('upload')) {
            $request->validate([
                'upload' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);
            $data['avatar'] = $request->file('upload')->store('user-avatar');
            if (!$request->oldImage == 'user-avatar/default.png') {
                Storage::delete($request->oldImage);
            }
        } else {
            $data['avatar'] = $request->oldImage;
        }

        if (Hash::check($request->password, auth()->user()->password)) {

            User::find(auth()->user()->id)->update($data);
            return redirect()->back()->with('success', 'Information updated');
        } else {
            return redirect()->back()->with('error', 'Credentials Incorret');
        }
    }

    public function saveLogin(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:4',
            'new_password' => 'required|min:4',
            'confirm_new_password' => 'required|min:4',
        ]);

        $data = [
            'password' => bcrypt($request->confirm_new_password)
        ];

        if (Hash::check($request->current_password, auth()->user()->password)) {
            if (Hash::check($request->new_password, bcrypt($request->confirm_new_password))) {
                User::find(auth()->user()->id)->update($data);

                FacadesMail::send('Email.emailChangePasswordEmail', ['client_ip_address' => $request->getClientIp()], function ($message) use ($request) {
                    $message->to(auth()->user()->email);
                    $message->subject('Password Changed');
                });

                return redirect()->back()->with('success', 'Login details updated');
            } else {
                return redirect()->back()->with('error', "Password confirmation doesn't match");
            }
        } else {
            return redirect()->back()->with('error', 'Credentials Incorret');
        }
    }
}