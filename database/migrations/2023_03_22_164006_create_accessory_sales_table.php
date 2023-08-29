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
        Schema::create('accessory_sales', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');
            $table->decimal('total', 9, 2);

            $table->foreignId('accessory_id')->constrained();
            $table->foreignId('sale_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessory_sales');
    }
};
