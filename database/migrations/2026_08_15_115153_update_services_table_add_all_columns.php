<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('platform')->after('id');
            $table->integer('min_qty')->default(100)->after('name');
            $table->integer('max_qty')->default(10000)->after('min_qty');
            $table->decimal('price_per_1000', 8, 2)->default(0)->after('max_qty');
            $table->string('status')->default('active')->after('price_per_1000');
            $table->text('description')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['platform', 'min_qty', 'max_qty', 'price_per_1000', 'status', 'description']);
        });
    }
};