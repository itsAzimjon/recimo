<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('order')->with(['orders' => $orders, 'areas' => Area::all(), 'users' => User::all()]);
    }

    public function accept(Order $order, Request $request)
    {
        $order->update(['status' => '1', 'edited_by' => $request->edited,]);
        return redirect()->back()->with('success', 'Order accepted successfully.');
    }

    public function reject(Order $order, Request $request)
    {
        $order->update(['status' => '2', 'edited_by' => $request->edited,]);
        return redirect()->back()->with('success', 'Order rejected successfully.');
    }
}
