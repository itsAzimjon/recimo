<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class AuthApiController extends Controller
{
    public function auth(Request $request)
    {
        $phone_number = $request->input('phone_number');
        Session::put('phone_number', $phone_number);
    
        $user = User::where('phone_number', $phone_number)->first();
        $pass = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        if($user->role_id == 5){
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
        }
        if ($user && $user->area_id !== null) {
            $user->update([
                'password' => Hash::make($pass)
            ]);
            return response()->json(['message' => 'login' , 'phone' =>  $phone_number]);

        } elseif ($user) {
            $user->update([
                'password' => Hash::make($pass)
            ]);
            return response()->json(['message' => 'register', 'phone' =>  $phone_number]);
        }
        else {
            User::create([
                'phone_number' => $request->phone_number,
                'name' => '0',
                'password' => Hash::make($pass),
            ]);
            return response()->json(['message' => 'register', 'phone' =>  $phone_number]);
        }
    }
    

    public function login(Request $request)
    {    
        if (!Auth::attempt($request->only('phone_number', 'password'))) {
            return response([
                'message' => 'SMS parol notog‘ri!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24 * 365);
    
        return response([
            'message' => 'Muvaffaqiyatli ro‘yxatdan o‘tdingiz',
            'token' => $token
        ])->withCookie($cookie);
    }
    
    public function register(Request $request)
    {
        $phone_number = $request->phone_number;

        $request->validate([
            'name' => 'required', 
            'area_id' => 'required', 
            'address' => 'required', 
        ]);

        $user = User::where('phone_number', $phone_number)->first();

        if (!$user) {
            return response()->json(['error' => 'Foydalanuvchi topilmadi'], 404);
        }

        $user->update([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'address' => $request->address,
        ]);

        $region = Region::findOrFail($user->area->region->id);
        $wallet = sprintf('%02d%02d%08d', $region->id, $user->area_id, $user->id);

        Wallet::create([
            'user_id' => $user->id,
            'wallet_number' => $wallet,
        ]);

        Auth::login($user);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Parol noto‘g‘ri'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24 * 365);

        return response([
            'message' => 'Muvaffaqiyatli ro‘yxatdan o‘tdingiz',
            'token' => $token
        ])->withCookie($cookie);
    }



    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
