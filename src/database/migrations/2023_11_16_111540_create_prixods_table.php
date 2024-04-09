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
        Schema::create('prixods', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('material_id')->constrained();
            // $table->foreignId('nakladnoy_id')->constrained();

            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->foreignId('nakladnoy_id')->constrained('nakladnoys')->onDelete('cascade');
            $table->string('unit');
            $table->string('quantity');
            $table->string('price');
            $table->string('sum');
            // $table->date('term');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prixods');
    }
};
