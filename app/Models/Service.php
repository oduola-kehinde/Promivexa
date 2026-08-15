<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'category',
        'name',
        'min_qty',
        'max_qty', 
        'price_per_1000',
        'client_price_per_1000',
        'worker_payout_per_task',
        'description',
        'status',
    ];
}