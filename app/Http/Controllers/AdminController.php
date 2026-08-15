<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    // Dashboard like JAP
    public function dashboard()
    {
        $total_users = User::count();
        $total_orders = Order::count();
        $total_services = Service::count();
        $total_balance = Transaction::where('type', 'deposit')->sum('amount');
        $pending_orders = Order::where('status', 'Pending')->count();

        return view('admin.dashboard', compact('total_users', 'total_orders', 'total_services', 'total_balance', 'pending_orders'));
    }

    // Manage Users
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    // Manage Transactions / Wallet
    public function transactions()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.transactions', compact('transactions'));
    }

    // Manage Orders
    public function orders()
    {
        $orders = Order::with('service', 'user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update Order Status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if($order){
            $order->status = $request->status;
            $order->save();
        }
        return back()->with('success', 'Order status updated to '.$request->status);
    }
}