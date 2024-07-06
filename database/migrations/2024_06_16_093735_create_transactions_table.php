<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *'user_id', 'car_id', 'rent_date', 'duration', 'penalty', 'with_driver', 'description',
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->date('rent_date');
            $table->string('price_car');
            $table->string('price_driver');
            $table->string('total');
            $table->integer('duration');
            $table->string('penalty')->nullable();
            $table->boolean('with_driver');
            $table->enum('status', ['DIPESAN', 'DIGUNAKAN', 'SELESAI', 'TERLAMBAT', 'BATAL'])->default('DIPESAN');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
