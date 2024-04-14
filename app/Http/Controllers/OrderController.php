<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Area;
use App\Models\Category;
use App\Models\Order;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->status == 3){
            $orders = Order::where('status',3)->latest()->paginate(50);
        }elseif($request->status == 2){
            $orders = Order::where('status',2)->latest()->paginate(50);
        }elseif($request->status == 1){
            $orders = Order::where('status',1)->latest()->paginate(50);
        }else{
            $orders = Order::latest()->paginate(50);
        }

        return view('order')->with(['orders' => $orders, 'areas' => Area::all(), 'users' => User::all(), 'types' => Type::all(), 'categories' => Category::all() ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric|min:0',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();}
        
        $order = Order::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'area' => $request->area,
            'address' => $request->address,
            'weight' => $request->weight,
            'price' => $request->price ?? 1
        ]);

        OrderCreated::dispatch($order);

        return redirect()->back();
    }

    public function order_attach(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
            'attachment' => $request->attachment,
        ]);

        return back();
    }

    public function accept(Order $order, Request $request)
    {
        $order->update(['status' => '1', 'edited_by' => $request->edited,]);
        return redirect()->back()->with('success', 'Buyurtma qabul qilindi');
    }

    public function acceptAgent(Order $order, Request $request)
    {
        $order->update([
            'status' => '1',
            'edited_by' => $request->edited,
            'attachment' => $request->attachment
        ]);
        return redirect()->back()->with('success', 'Buyurtma qabul qilindi');
    }

    public function reject(Order $order, Request $request)
    {
        $order->update(['status' => '2', 'edited_by' => $request->edited,]);
        return redirect()->back()->with('success', 'Buyurtma rad etildi');
    }
}
