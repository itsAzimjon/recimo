<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InfoUserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.user-profile')->with(['user' => $user, 'categories' => Category::all(), 'types' => Type::all()]);
    }   

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'passport' => $request->passport,
            'inn' => $request->inn,
        ];

        if ($request->password) {
            $data['password'] =  Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Muvofaqiyatli o‘zgartirildi');
    }   
}