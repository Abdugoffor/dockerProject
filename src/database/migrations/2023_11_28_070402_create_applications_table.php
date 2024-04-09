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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('firm_id')->constrained('firms')->onDelete('cascade');
            $table->bigInteger('courier_id')->nullable();
            // $table->string('type_dastavka')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('sum')->nullable();
            $table->string('protsent')->nullable();
            $table->string('payment')->nullable();
            $table->string('debtor')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->integer('status')->default(1);
            $table->integer('bugalter_status')->default(0);
            $table->integer('delivery_type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
