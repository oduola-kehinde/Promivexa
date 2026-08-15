<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'service_id' => 'required|integer|exists:services,id',
            'link' => 'required|url',
            'quantity' => 'required|integer|min:50',
        ]);

        $service = Service::find($request->service_id);
        if(!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $quantity = $request->quantity;
        $link = $request->link;

        // price per 1000
        $totalCost = ($service->our_price / 1000) * $quantity;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => 1, 
                'service_id' => $service->id,
                'link' => $link,
                'quantity' => $quantity,
                'total_cost' => $totalCost, // matches your DB
                'status' => 'pending'
            ]);

            $chunkSize = 1000;
            $tasksToCreate = [];

            for ($i = 0; $i < $quantity; $i += $chunkSize) {
                $currentChunk = min($chunkSize, $quantity - $i);
                $tasksToCreate[] = [
                    'order_id' => $order->id,
                    'service_id' => $service->id,
                    'link' => $link,
                    'quantity' => $currentChunk,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Task::insert($tasksToCreate);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'tasks_created' => count($tasksToCreate),
                'total_charge' => $totalCost
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}