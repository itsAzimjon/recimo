<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Base;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class OrderApiController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $orders = Order::where('user_id', $userId)->latest()->get();
        $baseRecords = Base::where('client_id', $userId)->latest()->get();
        $combinedResults = $orders->merge($baseRecords)->sortByDesc('created_at');
        $combinedResultsResource = OrderResource::collection($combinedResults);

        return $combinedResultsResource;
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'area' => auth()->user()->area->name,
            'address' => auth()->user()->address,
            'category_id' => $request->category_id,
            'weight' => $request->weight,
            'attachment' => $request->attachment ?? null,
            'status' => $request->status ?? 3,
            'price' => $request->price ?? 1
        ]);

        if($request->attachment != null){
            $order->update([
                'status' => 1,
            ]);
        }
        
        $attachment = $request->attachment ?? 1;
        $user = User::where('id', $attachment)->first();
        $category = $order->category->name;
        $address = $order->user->area->name . $order->user->address;

        $url = 'https://send.smsxabar.uz/broker-api/send';
        $username = 'ekosfera';
        $password = '!1(|iV?2Cg%7';

        $phone = $user->phone_number;
        $payload = [
            "messages" => [
                [
                    "recipient" => $phone,
                    "message-id" => "abc000000001",
                    "sms" => [
                        "originator" => "3700",
                        "content" => [
                            "text" => "Sizning shaxsiz kabenitingizga buyurtma keldi.\r\nManzil: $address \r\nTur: $category \r\nVazn: $order->weight"
                            ]
                    ]
                ]
            ]
        ];
        Http::withBasicAuth($username, $password)->post($url, $payload);       

    
        OrderCreated::dispatch($order);
    
        return response()->json(['message' => 'Order created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $base = Base::find($id);

        $base->update([
            'status' => $request->input('status'),
        ]);

        return response()->json(['message' => 'Resource updated successfully'], 200);
    }


}
