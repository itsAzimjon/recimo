<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class AuthApiController extends Controller
{
    // public function login (Request $request)
    // {
    //     if (!Auth::attempt($request->only ( 'phone_number', 'password'))) {
    //         return response([
    //             'message' => 'Invalid credentials!'
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }
        
    //     /** @var \App\Models\User $user **/

    //     $user = Auth::user();
    //     $token = $user->createToken('token')->plainTextToken;
    //     $cookie = cookie('jwt', $token, 60 * 24 * 365);

    //     return response([
    //         'massage' => $token
    //     ])->withCookie($cookie);
    // }
    
    // app/Http/Controllers/LoginRegisterController.php

    // public function login (Request $request)
    // {
    //     $user = User::where('phone_number', $request->input('phone_number'))->first();
    //     if ($user) {
    //         // User is registered, perform login
    //         Auth::login($user);
    //     } else {
    //         // User is not registered, create a new user
    //         $user = User::create([
    //             'phone_number' => $request->input('phone_number'),
    //             'name' => 'User',
    //             'password' => bcrypt(Str::random(12)), // Temporary password for registration
    //             // Add other user data fields as needed
    //         ]);

    //         Auth::login($user);
    //     }

    //     $token = $user->createToken('token')->plainTextToken;
    //     $cookie = cookie('jwt', $token, 60 * 24 * 365);

    //     return response([
    //         'message' => 'Login and registration successful',
    //         'token' => $token,
    //     ])->withCookie($cookie);
    // }
    
    public function loginOrRegister(Request $request)
    {
        $phone_number = $request->input('phone_number');
        Session::put('phone_number', $phone_number);

        $user = User::where('phone_number', $phone_number)->first();

        if ($user) {
            return $this->login($request);
        } else {
            return $this->register($request);
        }
    }

    public function login(Request $request)
    {
        $phone_number = Session::get('phone_number');
        if (!Auth::attempt($request->only ( 'phone_number', 'password'))) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        /** @var \App\Models\User $user **/

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24 * 365);

        return response([
            'massage' => $cookie
        ])->withCookie($cookie);
    }

    public function register(Request $request)
    {
        $phone_number = Session::get('phone_number');
        $request->validate([
            'name' => 'required',
        ]);
    
        $user = User::create([
            'phone_number' => $request->input($phone_number),
            'name' => $request->input('name'),
            'password' => bcrypt(Str::random(12)), // Temporary password for registration
            // Add other user data fields as needed
        ]);
    
        Auth::login($user);
    
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24 * 365);
    
        return response([
            'message' => 'Registration successful',
            'token' => $token,
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
