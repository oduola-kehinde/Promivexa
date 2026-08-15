<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\Service;
use Illuminate\Support\Facades\Http;

class SendTasksToJap extends Command
{
    protected $signature = 'jap:send-tasks';
    protected $description = 'Send pending tasks to JAP API';

    public function handle()
    {
        $tasks = Task::where('status', 'pending')->limit(10)->get(); // send 10 at a time
        
        if($tasks->count() == 0) {
            $this->info('No pending tasks');
            return;
        }

        $this->info('Sending '.$tasks->count().' tasks to JAP...');

        foreach($tasks as $task) {
            $order = $task->order;
            $service = $order->service;

            // CALL JAP API HERE
            $response = Http::post('https://jap-panel.com/api/v2', [
                'key' => env('JAP_API_KEY'), // we will add this to .env
                'action' => 'add',
                'service' => $service->jap_service_id,
                'link' => $order->link,
                'quantity' => $task->quantity,
            ]);

            if($response->successful()) {
                $task->update([
                    'status' => 'sent_to_jap',
                    'jap_task_id' => $response->json('order'),
                    'sent_at' => now()
                ]);
                $this->info('Task '.$task->id.' sent to JAP');
            } else {
                $task->update(['status' => 'failed']);
                $this->error('Task '.$task->id.' failed');
            }
        }

        $this->info('Done!');
    }
}