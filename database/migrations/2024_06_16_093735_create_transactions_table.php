<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->string('price_product');

            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->integer('duration');
            $table->string('penalty')->nullable();

            $table->enum('status', [
                'MENUNGGU_KONFIRMASI',
                'DIKONFIRMASI',
                'DALAM_PENGGUNAAN',
                'SELESAI',
                'BATAL',
                'TERLAMBAT',
            ])->default('MENUNGGU_KONFIRMASI');
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
