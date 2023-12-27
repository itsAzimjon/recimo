<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Base;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

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
     
        Base::create([
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'client_id' => $request->client_id,
            'import' => $request->sale,
            'status' => $request->status ?? 1,
        ]);

        Base::create([
            'user_id' => $request->client_id,
            'type_id' => $request->type_id,
            'client_id' => $request->user_id,
            'export' => $request->sale,
            'status' => $request->status ?? 1,
        ]);

    

        return back()->with('success', 'Amaliyot muvofaqiatli yakunlandi');
    }

    public function createNewProduct(Request $request)
    {
        Base::create([
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'client_id' => 8,
            'import' => $request->sale,
            'status' => $request->status ?? 1,
        ]);
        return back()->with('success', 'Amaliyot muvofaqiatli yakunlandi');
    }

    public function importFromClient(Request $request)
    {
        Base::create([
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'client_id' => $request->user_id,
            'import' => $request->sale,
            'status' => $request->status ?? 1,
        ]);
        
        return back()->with('success', 'Amaliyot muvofaqiatli yakunlandi');
    }

}
