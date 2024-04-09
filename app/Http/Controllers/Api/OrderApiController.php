<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExportResource;
use App\Http\Resources\OrderResource;
use App\Models\Base;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class OrderApiController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
    
        $perPage = $request->has('per_page') ? (int) $request->per_page : 10;
        $orders = Order::where('user_id', $userId)->latest()->paginate($perPage);    
        $ordersResource = OrderResource::collection($orders);
    
        return $ordersResource;
    }

    public function export(Request $request)
    {
        $userId = auth()->id();
    
        $perPage = $request->has('per_page') ? (int) $request->per_page : 10;
        $baseRecords = Base::where('client_id', $userId)->latest()->paginate($perPage);
        $baseRecordsResource = ExportResource::collection($baseRecords);
    
        return $baseRecordsResource;
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
                            "text" => "Sizning shaxsiz kabenitingizga buyurtma keldi.\r\nManzil: $address"
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
        $type_id = $base->type_id;
        $type = Type::find($type_id);
        $product_price = $base->import * $type->price;

        $status = $request->input('status');

        if($base->user->wallet->money >= $product_price || $base->card == null){
            if($status == 1 && $base->status == 3){
                
                $user = $base->user;
                $per = $user->commission;
                $cost = $product_price * $per;
                $sum = $user->wallet->money - $cost;
                $user->wallet->update(['money' => $sum]);
                
                $admin = User::find(1);
                $commis = $admin->wallet->money + $cost;
                $admin->wallet->update(['money' => $commis]);
                
                if($base->card == 1){
                    $client = User::find($base->client_id);
                    $client_money = $client->wallet->money + $product_price;
                    $client->wallet->update(['money' => $client_money]);
                    
                    $agent_money = $user->wallet->money - $product_price;
                    $user->wallet->update(['money' => $agent_money]);

                    Transaction::create([
                        'user_id' => $user->id,
                        'client_id' => $client->id,
                        'amount' => $product_price,
                        'method' => 1,
                        'in_out' => 2
                    ]);

                    Transaction::create([
                        'user_id' => $client->id,
                        'client_id' => $user->id,
                        'amount' => $product_price,
                        'method' => 1,
                        'in_out' => 1
                    ]);
                }
            }
            
            $base->update([
                'status' => $status,
            ]);
            
            return response()->json(['message' => "Buyurtma tasdiqlandi"], 200);
        }else{
            return response()->json(['message' => "Agent hisobida mablag‘ yetarli emas"], 405);
        }
    }
}
