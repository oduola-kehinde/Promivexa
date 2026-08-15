<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('jap_task_id')->nullable(); // ID from JAP after we send
            $table->integer('quantity'); // e.g. 100 followers per task
            $table->enum('status', ['pending', 'sent_to_jap', 'completed', 'failed'])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};