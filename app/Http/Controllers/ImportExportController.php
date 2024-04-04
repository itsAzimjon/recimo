<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\Base;
use App\Models\Type;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ImportExportController extends Controller
{
    public function import($id)
    {
        $user = User::findOrFail($id);
        $bases = Base::latest()->paginate(80);
        return view('import')->with(['bases' => $bases, 'areas' => Area::all(), 'user' => $user, 'users' => User::all(), 'types' => Type::all() ]);
    }

    public function export($id)
    {
        $user = User::findOrFail($id);
        $bases = Base::latest()->paginate(80);
        return view('export')->with(['bases' => $bases, 'areas' => Area::all(), 'user' => $user ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type_id' => 'required|exists:types,id',
            'client_id' => 'required|exists:users,id',
            'sale' => 'required|array',
        ]);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'type_id' => 'required|exists:types,id',
            'client_id' => 'required', 'exists:users,id',
            'sale' => 'required|array',
        ]);
    
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', 'Xato boshqatdan urinib ko\'ring');
        }
    
        foreach ($request->type_id as $key => $typeId) {
            $token = Str::random(60);
            Base::create([
                'user_id' => $request->user_id,
                'type_id' => $typeId,
                'client_id' => $request->client_id,
                'import' => $request->sale[$key],
                'status' => $request->status ?? 3,
                'token' => $token,
            ]);
    
            Base::create([
                'user_id' => $request->client_id,
                'type_id' => $typeId,
                'client_id' => $request->user_id,
                'export' => $request->sale[$key],
                'status' => $request->status ?? 3,
                'token' => $token,
            ]);
        }

        return back()->with('success', 'Amaliyot muvofaqiatli yakunlandi');
    }

    public function createNewProduct(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type_id' => 'required|exists:types,id',
            'sale' => 'required|numeric',
        ]);

        $token = Str::random(60);
        Base::create([
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'client_id' => 8,
            'import' => $request->sale,
            'status' => $request->status ?? 1,
            'token' => $token,
        ]);
        return back()->with('success', 'Amaliyot muvofaqiatli yakunlandi');
    }

    public function importFromClient(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type_id' => 'required|exists:types,id',
            'client_id' => 'required|exists:users,id',
            'sale' => 'required|array',
        ]);

        foreach ($request->type_id as $key => $typeId) {
            $token = Str::random(60);
            Base::create([
                'user_id' => $request->user_id,
                'type_id' => $typeId,
                'client_id' => $request->client_id,
                'import' => $request->sale[$key], 
                'status' => $request->status ?? 3,
                'token' => $token,
            ]);
        }
        
        return back()->with('success', 'Amaliyot muvofaqiatli yakunlandi');
    }

}
