<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::post('/place-order', [TaskController::class, 'placeOrder']);