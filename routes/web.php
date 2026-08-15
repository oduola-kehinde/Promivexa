<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;
use App\Models\Order;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Homepage
Route::get('/', function () {
    return redirect('/dashboard');
});

// Customer Dashboard - Shows Services
Route::get('/dashboard', function () {
    $services = Service::where('status', 'active')->get();
    return view('dashboard', ['services' => $services]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Order Form Page
Route::get('/order/{service}', function (Service $service) {
    return view('order', ['service' => $service]);
})->middleware(['auth'])->name('order.create');

// Place Order - Save to DB
Route::post('/order/{service}', function (Request $request, Service $service) {
    $request->validate([
        'link' => 'required|string',
        'quantity' => 'required|integer|min:'.$service->min_qty.'|max:'.$service->max_qty,
    ]);

    $price = ($request->quantity / 1000) * $service->client_price_per_1000;

    Order::create([
        'user_id' => Auth::id(),
        'service_id' => $service->id,
        'link' => $request->link,
        'quantity' => $request->quantity,
        'charge' => $price,
        'status' => 'Pending'
    ]);

    return redirect('/dashboard')->with('success', 'Order Placed Successfully!');
})->middleware(['auth'])->name('order.store');


// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breeze Auth Routes
require __DIR__.'/auth.php';