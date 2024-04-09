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
        Schema::create('tabels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staf_id')->constrained('stafs')->onDelete('cascade');
            $table->date('date');
            $table->string('stavka');
            $table->string('how_many');
            $table->string('clock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabels');
    }
};
