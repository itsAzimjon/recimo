<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserApiController extends Controller
{

    public function index()
    {
        return Auth::user();
    }

    public function agents()
    {
        $users = User::all();

        $agents = $users->filter(function ($user) {
            return $user->role_id == 3;
        });
    
        $agentsResource = UserResource::collection($agents);
    
        return $agentsResource;
    }

    public function store(Request $request)
    {
        //
    }
 
    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // If the user is not found, return a not found response
        if (!$user) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        if($request->hasFile('photo')){
            if(isset($user->photo)){
                Storage::delete($user->photo);
            }
            $path = $request->file('photo')->store('profile-photo');
        }

        $user->update([
            'name' => $request->input('name'),
            'photo' => $path ?? $user->photo,
            'area_id' => $request->input('area_id'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
        ]);

        // Optionally, you can return the updated resource in the response
        return response()->json(['message' => 'Resource updated successfully'], 200);
    }
}
