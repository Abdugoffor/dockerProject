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
        Schema::create('model_product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('cascade');
            $table->foreignId('model_product_id')->constrained('model_products')->onDelete('cascade');
            $table->foreignId('product_stok_id')->constrained('product_stoks')->onDelete('cascade');
            $table->unsignedBigInteger('count');
            $table->integer('lose');
            $table->unsignedBigInteger('successful')->default(0);
            $table->unsignedBigInteger('defective')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_product_orders');
    }
};
