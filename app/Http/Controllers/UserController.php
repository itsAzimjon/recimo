<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\Base;
use App\Models\Region;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:555',
            'area_id' => 'required|exists:areas,id',
            'passport' => 'required|string|max:55',
            'inn' => 'nullable|string|max:55',
            'commission' => 'required|regex:/^\d*(\.\d+)?$/'
        ]);
        
        if ($validator->fails()) {return back()->withErrors($validator)->withInput();}

        $user = User::create([
            'name' => $request->name,
            'photo' => $path ,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'area_id' => $request->area_id,
            'passport' => $request->passport,
            'inn' => $request->inn,
            'commission' => $request->commission,
            'role_id' => $request->role_id,
            'remember_token' => Str::random(60),
            'password' => Hash::make(Str::random(20)),
        ]);
    
        if ($request->has('types')) {
            foreach ($request->types as $type) {
                $user->types()->attach($type);
            }
        }

        
        $region = Region::findOrFail($user->area->region->id);
        $wallet = sprintf('%02d%02d%08d', $region->id, $user->area_id, $user->id);
        
        Wallet::create([
            'user_id' => $user->id,
            'wallet_number' => $wallet,
        ]);
        
        if($request->amount != null){
            Transaction::create([
                'user_id' => $user->id,
                'client_id' => auth()->user()->id,
                'amount' => $request->amount,
                'method' => $request->method ?? 2,
                'in_out' => $request->in_out ?? 1
            ]);

            $user->wallet->update([
                'money' => $request->amount
            ]);
        }

        return back()->with('success', 'Muvofaqiyatli yaratildi');
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
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'area_id' => $request->area_id,
            'passport' => $request->passport,
            'inn' => $request->inn,
            'commission' => $request->commission,
        ];

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:555',
            'area_id' => 'required|exists:areas,id',
            'passport' => 'required|string|max:55',
            'inn' => 'nullable|string|max:55',
            'commission' => 'required|regex:/^\d*(\.\d+)?$/'
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

        if($request->amount != null){
            Transaction::create([
                'user_id' => $user->id,
                'client_id' => auth()->user()->id,
                'amount' => $request->amount,
                'method' => $request->method ?? 2,
                'in_out' => $request->in_out ?? 1
            ]);

            $money = $user->wallet->money + $request->amount;
            $user->wallet->update([
                'money' => $money
            ]);
        }

        return back()->with('success', 'Muvofaqiyatli o‘zgartirildi');
    }


    public function destroy(User $user)
    {
        //Storage::delete($user->photo);
        if ($user->active == 1) {
            $user->update([
                'active' => 2
            ]);
        } else {
            $user->update([
                'active' => 1
            ]);
        }
        
        return redirect()->back()->with('success', 'Foydalanuvchi o‘zgartirildi');
    }    
}
