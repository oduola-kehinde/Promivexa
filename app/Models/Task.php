<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['order_id', 'service_id', 'link', 'quantity', 'status'];
}