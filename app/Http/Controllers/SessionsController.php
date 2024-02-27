<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'phone_number'=>'required',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect()->route('dashboard', ['id' => Auth::id()]);
        }
        else{

            return back()->withErrors(['phone_number'=>'Telefon raqam yoki parol noto‘g‘ri']);
        }
    }
    
    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
