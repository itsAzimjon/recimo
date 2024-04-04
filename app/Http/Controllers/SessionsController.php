<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function send_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|max:9|min:9',
        ]);

        if ($validator->fails()) {return back()->withErrors($validator)->withInput();}

        $phone_number = $request->input('phone_number');

        $user = User::where('phone_number', $phone_number)->first();
        $pass = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $url = 'https://send.smsxabar.uz/broker-api/send';
        $username = 'ekosfera';
        $password = '!1(|iV?2Cg%7';

        $payload = [
            "messages" => [
                [
                    "recipient" => $phone_number,
                    "message-id" => "abc000000001",
                    "sms" => [
                        "originator" => "3700",
                        "content" => [
                            "text" => "Ro‘yxatsan o‘tish kodi: $pass"
                        ]
                    ]
                ]
            ]
        ];
        Http::withBasicAuth($username, $password)->post($url, $payload);
        if ($user) {
            $user->update([
                'password' => Hash::make($pass)
            ]);
            return back();
        } else {
            return back()->withErrors(['phone_number' => 'Bunday foydalanuvchi mavjud emas!']);
        }
    }

    public function store()
    {
        $attributes = request()->validate([
            'phone_number' => 'required',
            'password' => 'required'
        ]);
    
        if ($user = User::where('phone_number', $attributes['phone_number'])->first()) {
            if ($user->active == 1) {
                if (Auth::attempt($attributes)) {
                    $newPassword = Str::random(20);
    
                    DB::table('users')->where('id', $user->id)->update([
                        'password' => Hash::make($newPassword)
                    ]);
    
                    session()->regenerate();
    
                    return redirect()->route('dashboard', ['id' => $user->id]);
                } else {
                    return back()->withInput()->withErrors(['password' => 'Tasdiqlash kodi noto‘g‘ri']);
                }
            } else {
                return back()->withInput()->withErrors(['phone_number' => 'Profil faol emas']);
            }
        } else {
            return back()->withInput()->withErrors(['phone_number' => 'Foydalanuvchhi topilmadi']);
        }
    }
    
    
    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
