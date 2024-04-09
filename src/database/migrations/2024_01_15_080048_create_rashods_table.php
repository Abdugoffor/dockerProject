<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rashods', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [1, 2])->default(1);
            $table->integer('type_sum');
            $table->foreignId('application_id')->nullable()->default(null);
            $table->foreignId('nakladnoy_id')->nullable()->default(null);
            $table->string('boshqa')->nullable()->default(null);
            $table->string('sum');
            $table->float('kurs')->nullable();
            $table->text('text')->nullable();
            $table->timestamps();

            $table->foreign('application_id')->on('applications')->references('id');

            $table->foreign('nakladnoy_id')->on('nakladnoys')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rashods');
    }
};
