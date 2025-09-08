<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariantAttribute>
 */
class ProductVariantAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $attributeSets = [
            ['key' => 'color', 'value' => $this->faker->randomElement(['Red', 'Blue', 'Green', 'Black'])],
            ['key' => 'size', 'value' => $this->faker->randomElement(['S', 'M', 'L', 'XL'])],
            ['key' => 'material', 'value' => $this->faker->randomElement(['Cotton', 'Polyester', 'Denim'])],
        ];
        return array_merge(
            [
                'variant_id' => ProductVariant::factory(),
            ],
            $this->faker->randomElement($attributeSets)
        );
    }
}
