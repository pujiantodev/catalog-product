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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->string('name')->nullable(); // opsional, bisa kosong
            $table->string('sku')->unique();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('stock')->default(0);
            $table->decimal('weight')->nullable();
            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->boolean('is_default')->default(false);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
