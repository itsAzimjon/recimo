<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'name' => 'required',
        ]);
        

        Area::create([
            'region_id'=> $request->region_id,
            'name'=>$request->name,
        ]);

        return back()->with('success', 'Qo‘shildi');    
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
             'name' => 'required',
        ]);

        $area->update([
            'region_id'=> $request->region_id,
            'name'=> $request->name,
        ]);

        return back()->with('success', 'O‘zgartirildi');    
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('success', 'O‘chrildi');    
    }
}
