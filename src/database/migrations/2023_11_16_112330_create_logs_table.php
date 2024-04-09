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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(1);
            $table->integer('increment')->default(1);
            $table->foreignId('material_id')->constrained();
            $table->string('quantity');
            $table->string('went');
            $table->string('remained');
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreignId('to_id')->constrained('material_stoks');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
