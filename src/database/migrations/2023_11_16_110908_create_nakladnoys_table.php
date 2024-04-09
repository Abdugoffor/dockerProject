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
        Schema::create('nakladnoys', function (Blueprint $table) {
            $table->id();
            $table->string('shipper');
            $table->string('consignee');
            $table->integer('nomer');
            $table->date('date');
            $table->string('sender');
            $table->string('recipient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nakladnoys');
    }
};
