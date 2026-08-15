<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1); // temp fix
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('link');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Processing', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};