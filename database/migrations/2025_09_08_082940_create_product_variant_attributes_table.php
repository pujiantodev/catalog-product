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
        Schema::create('product_variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('product_variants', 'id')->cascadeOnDelete();
            $table->string('key');   // e.g. "color", "size"
            $table->string('value'); // e.g. "Red", "XL"
            $table->timestamps();

            $table->index(['variant_id', 'key', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attributes');
    }
};
