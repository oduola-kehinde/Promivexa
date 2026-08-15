<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // 1. FOR HOMEPAGE
    public function home()
    {
        $services = Service::where('status', 'Active')->get();
        return view('welcome', compact('services'));
    }

    // 2. FOR ADMIN - LIST
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // 3. FOR ADMIN - CREATE FORM
    public function create()
    {
        return view('admin.services.create');
    }

    // 4. FOR ADMIN - STORE
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'client_price_per_1000' => 'required|numeric',
            'worker_payout_per_task' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'description' => 'required',
            'status' => 'required',
        ]);

        Service::create($request->all());
        
        return redirect()->route('admin.services.index')->with('success', 'Service Added Successfully!');
    }
}