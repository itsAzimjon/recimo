<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Base;
use App\Models\Category;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $roleId = $request->input('role_id');

        $users = User::select(['users.*'])
            ->addSelect(['total_import' => Base::selectRaw('SUM(import)')->whereColumn('user_id', 'users.id')])
            ->addSelect(['types' => Type::selectRaw('GROUP_CONCAT(name)')->whereColumn('type_user.user_id', 'users.id')])
            ->leftJoin('type_user', 'users.id', '=', 'type_user.user_id')
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%")
                    ->orWhere('llc', 'like', "%$searchQuery%")
                    ->orWhere('phone_number', 'like', "%$searchQuery%")
                    ->orWhere('address', 'like', "%$searchQuery%")
                    ->orWhere('passport', 'like', "%$searchQuery%")
                    ->orWhere('inn', 'like', "%$searchQuery%");
            })
            ->orWhereExists(function ($query) use ($searchQuery) {
                $query->select(DB::raw(1))
                    ->from('type_user')
                    ->join('types', 'type_user.type_id', '=', 'types.id')
                    ->whereColumn('type_user.user_id', 'users.id')
                    ->where('types.name', 'like', "%$searchQuery%");
            })
            ->orderByDesc('total_import')
            ->distinct() // Ensure distinct user records
            ->get();

        return view('search-results', compact('users', 'roleId'));
    }


    public function index()
    {
        $users = User::latest()->get();
        return view('users.user-management')->with(['users' => $users, 'areas' => Area::all()]);
    }

    public function agent()
    {
        $users = User::latest()->get();
        return view('users.agent-management')->with(['users' => $users, 'types' => Type::all(), 'areas' => Area::all()]);
    }

    public function company()
    {
        $users = User::latest()->get();
        return view('users.company-management')->with(['users' => $users, 'types' => Type::all(), 'areas' => Area::all()]);
    }

    public function store(Request $request)
    {
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photo');
        } else {
            $path = null;
        }
        

        $user = User::create([
            'name' => $request->name,
            'photo' => $path ,
            'llc' => $request->llc,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'area_id' => $request->area_id,
            'passport' => $request->passport,
            'inn' => $request->inn,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
    
        if ($request->has('types')) {
            foreach ($request->types as $type) {
                $user->types()->attach($type);
            }
        }

        return back()->with('success', 'Muvofaqiyatli o‘zgartirildi');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit')->with(['user' => $user, 'types' => Type::all(), 'bases' => Base::all(), 'areas' => Area::all()]);
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
            'llc' => $request->llc,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'area_id' => $request->area_id,
            'passport' => $request->passport,
            'inn' => $request->inn,
        ];
        if ($request->password) {
            $data['password'] =  Hash::make($request->password);
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


    public function destroy(User $user)
    {
        //Storage::delete($user->photo);
   
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
        
    }
    
    
}
