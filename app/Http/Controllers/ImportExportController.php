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
        $bases = Base::latest()->paginate(40);
        return view('import')->with(['bases' => $bases, 'areas' => Area::all(), 'user' => $user, 'users' => User::all(), 'types' => Type::all() ]);
    }

    public function export($id)
    {
        $user = User::findOrFail($id);
        $bases = Base::latest()->paginate(40);
        return view('export')->with(['bases' => $bases, 'areas' => Area::all(), 'user' => $user ]);
    }

    public function store(Request $request)
    {
     
       // Create the first record with 'import'
        Base::create([
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'client_id' => $request->client_id,
            'import' => $request->sale,
        ]);

        // Create the second record with 'export' and swapped 'user_id' and 'client_id'
        Base::create([
            'user_id' => $request->client_id, // Swap user_id and client_id
            'type_id' => $request->type_id,
            'client_id' => $request->user_id, // Swap user_id and client_id
            'export' => $request->sale,
        ]);

    

        return back()->with('success', 'Muvofaqiyatli o‘zgartirildi');
    }


}
