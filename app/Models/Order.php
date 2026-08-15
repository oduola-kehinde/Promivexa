<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'service_id', 
        'link', 
        'quantity', 
        'total_cost', 
        'status'
    ];

    // RELATIONSHIP: 1 Order belongs to 1 Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // RELATIONSHIP: 1 Order belongs to 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}