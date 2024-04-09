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
        Schema::create('product_stok_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_stok_id')->constrained('product_stoks');
            $table->foreignId('model_product_id')->constrained('model_products');
            $table->unsignedBigInteger('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stok_values');
    }
};
