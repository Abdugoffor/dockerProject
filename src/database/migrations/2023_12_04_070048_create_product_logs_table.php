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
        Schema::create('product_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(1); // 1 ishlab chiqarib yuborildi, 2 transfer
            $table->integer('increment')->default(1);  // 1 qo'shilish, 2 ayirilish
            $table->foreignId('model_product_id')->constrained();
            $table->string('quantity'); 
            $table->string('went');  // nechta edi 
            $table->string('remained'); // nechta qoldi
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreignId('to_id')->constrained('product_stoks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_logs');
    }
};
