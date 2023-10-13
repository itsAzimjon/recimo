<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('base')->with(['user' => $user, 'users' => User::all(), 'types' => Type::all()]);
    }   
}
