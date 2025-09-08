<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory()->create()->id, // atau pakai existing ID saat seeding
            'name' => $this->faker->words(2, true), // contoh: "Red XL"
            'sku' => 'SKU-' . strtoupper(Str::random(8)),
            'price' => $this->faker->numberBetween(50000, 250000),
            'stock' => $this->faker->numberBetween(0, 100),
            'weight' => $this->faker->randomFloat(2, 0.1, 5.0),
            'length' => $this->faker->randomFloat(2, 10, 50),
            'width' => $this->faker->randomFloat(2, 10, 50),
            'height' => $this->faker->randomFloat(2, 1, 20),
            'is_default' => false,
            'display_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
