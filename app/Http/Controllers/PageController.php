<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::all();
        return view('home', compact('services'));
    }

    public function orderForm(Service $service)
    {
        return view('order', compact('service'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'link' => 'required',
            'quantity' => 'required|integer|min:100'
        ]);

        $service = Service::find($request->service_id);
        $charge = ($request->quantity / 1000) * $service->price_per_1000;

        Order::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'link' => $request->link,
            'quantity' => $request->quantity,
            'charge' => $charge,
            'status' => 'Pending'
        ]);

        return back()->with('success', 'Order placed successfully!');
    }
}