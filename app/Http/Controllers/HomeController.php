<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return redirect()->route('dashboard', ['id' => Auth::id()])->with(['success'=>'You are logged in.']);
    }
}
