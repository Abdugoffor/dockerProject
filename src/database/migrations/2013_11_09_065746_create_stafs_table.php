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
        Schema::create('stafs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('adres');
            $table->string('img')->nullable();
            $table->string('file')->nullable();
            $table->string('working_time');
            $table->string('sum');
            $table->string('hourly');
            $table->foreignId('department_id')->constrained(); 
            $table->foreignId('salary__type_id')->constrained(); 
            // $table->foreignId('position_id')->constrained('positions')->onDelete('cascade');
            // $table->foreignId('salary__type_id')->constrained('salary__types')->onDelete('cascade');
            $table->text('text')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stafs');
    }
};
