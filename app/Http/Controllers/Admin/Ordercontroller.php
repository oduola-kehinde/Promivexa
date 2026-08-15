<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. FOR ADMIN - LIST ALL ORDERS
    public function index()
    {
        $orders = Order::with('service')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 2. FOR USER - SAVE NEW ORDER FROM HOMEPAGE
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'link' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        Order::create([
            'service_id' => $request->service_id,
            'link' => $request->link,
            'quantity' => $request->quantity,
            'status' => 'Pending', // default status
        ]);

        return redirect()->route('home')->with('success', 'Order Placed Successfully!');
    }

    // 3. FOR ADMIN - UPDATE ORDER STATUS
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order Status Updated!');
    }
}