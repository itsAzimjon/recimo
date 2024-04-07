<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('wallet', compact('user'));
    }
}
