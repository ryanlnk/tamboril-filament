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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('quantity');
            $table->decimal('buy_price', 9, 2);
            $table->decimal('sale_price', 9, 2);
            $table->date('date');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('genre')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('box')->nullable();
            $table->longText('description');

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
