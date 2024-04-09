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
        Schema::create('salary__type__values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staf_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->date('date');
            // $table->foreignId('salary_id')->constrained('salarys')->onDelete('cascade');
            // $table->foreignId('type_id')->constrained('types')->onDelete('cascade');
            $table->string('value');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary__type__values');
    }
};
