<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Task;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // 1. Create the customer order
        $service = Service::find($request->service_id);
        $order = Order::create([
            'user_id' => 1, // auth()->id() later
            'service_id' => $request->service_id,
            'link' => $request->link,
            'quantity' => $request->quantity,
            'total_cost' => ($request->quantity * $service->our_price) / 1000,
            'status' => 'processing'
        ]);

        // 2. AUTO-SPLIT LOGIC: Split into chunks of 100
        $chunkSize = 100;
        $totalTasks = ceil($order->quantity / $chunkSize);

        for ($i = 0; $i < $totalTasks; $i++) {
            $taskQuantity = ($i == $totalTasks - 1) 
                ? $order->quantity - ($chunkSize * $i) // last chunk
                : $chunkSize;

            Task::create([
                'order_id' => $order->id,
                'quantity' => $taskQuantity,
                'status' => 'pending'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order placed and split into '.$totalTasks.' tasks', 
            'order_id' => $order->id
        ]);
    }
}