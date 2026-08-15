<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'platform' => 'Instagram',
            'category' => 'Social Media',
            'name' => 'Followers',
            'min_qty' => 100,
            'max_qty' => 100000,
            'price_per_1000' => 5.00,
            'client_price_per_1000' => 6.00,
            'worker_payout_per_task' => 0.50,
            'description' => 'High Quality IG Followers. Start time: 0-1 Hour',
            'status' => 'active'
        ]);

        Service::create([
            'platform' => 'TikTok',
            'category' => 'Social Media',
            'name' => 'Followers',
            'min_qty' => 100,
            'max_qty' => 50000,
            'price_per_1000' => 3.00,
            'client_price_per_1000' => 3.60,
            'worker_payout_per_task' => 0.30,
            'description' => 'Real TikTok Followers. Start time: 0-1 Hour',
            'status' => 'active'
        ]);

        Service::create([
            'platform' => 'YouTube',
            'category' => 'Social Media',
            'name' => 'Views',
            'min_qty' => 1000,
            'max_qty' => 1000000,
            'price_per_1000' => 2.50,
            'client_price_per_1000' => 3.00,
            'worker_payout_per_task' => 0.20,
            'description' => 'YouTube Video Views. Start time: 0-30 Minutes',
            'status' => 'active'
        ]);
    }
}