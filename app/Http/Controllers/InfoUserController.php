<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Region;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InfoUserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.user-profile')->with(['user' => $user, 'types' => Type::all(), 'regions' => Region::all(), 'areas' => Area::all()]);
    }   

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if($request->hasFile('photo')){
            if(isset($user->photo)){
                Storage::delete($user->photo);
            }
            $path = $request->file('photo')->store('profile-photo');
        }

        $data = [
            'name' => $request->name,
            'photo' => $path ?? $user->photo,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'area_id' => $request->area_id,
            'passport' => $request->passport,
            'inn' => $request->inn,
        ];

        if ($request->password) {
            $data['password'] =  Hash::make($request->password);
        }

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:555',
            'area_id' => 'required|exists:areas,id',
            'passport' => 'required|string|max:55',
            'inn' => 'nullable|string|max:55',
        ]);
        
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->types()->detach();
        if ( isset($request->types)){
            foreach ($request->types as $type) {
                $user->types()->attach($type);
            }
        }


        $user->update($data);

        return back()->with('success', 'Muvofaqiyatli o‘zgartirildi');
    }   
}