<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Base;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('base')->with(['user' => $user, 'users' => User::all(), 'types' => Type::all()]);
    }   

    public function confirmation($id)
    {
        $user = User::findOrFail($id);
        $bases = Base::latest()->paginate(80);
        $areas = Area::all();
        $users = User::all();
        $types = Type::all();
        return view('confirmation', compact(['user','areas', 'bases', 'users','types']));
    }

    public function onConfirm(Request $request)
    {
        $token = $request->token;
        $status = $request->status;
        $base = Base::where('token',$token)->first();
        Base::where('token', $token)->update(['status' => $status]);

        if($status == 1){
            $user = User::findOrFail($request->ex_user);
            $per = $user->commission;
            $cost = $request->cost * $per;
            $sum = $user->wallet->money - $cost;
            $user->wallet->update(['money' => $sum]);
            
            $admin = User::find(1);
            $commis = $admin->wallet->money + $cost;
            $admin->wallet->update(['money' => $commis]);
            
            if($base->card === 1){
                $client = User::findOrFail($base->client_id);
                $client_money = $client->wallet->money + $request->cost;
                $client->wallet->update(['money' => $client_money]);
                
                $agent_money = $user->wallet->money - $request->cost;
                $user->wallet->update(['money' => $agent_money]);

                Transaction::create([
                    'user_id' => $user->id,
                    'client_id' => $client->id,
                    'amount' => $request->cost,
                    'method' => 1,
                    'in_out' => 2
                ]);

                Transaction::create([
                    'user_id' => $client->id,
                    'client_id' => $user->id,
                    'amount' => $request->cost,
                    'method' => 1,
                    'in_out' => 1
                ]);
            }
        }

        
        return back();
    }
}
