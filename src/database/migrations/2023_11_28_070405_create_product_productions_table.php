<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_product_order_id')->constrained('model_product_orders')->onDelete('cascade');
            $table->foreignId('model_product_id')->constrained('model_products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained();
            $table->unsignedBigInteger('count');
            $table->unsignedBigInteger('successful')->default(0);
            $table->unsignedBigInteger('defective')->default(0);
            $table->integer('status')->default(1);
            $table->dateTime('start')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_productions');
    }
};
