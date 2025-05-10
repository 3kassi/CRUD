<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCard>
 */
class ProductCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => strtoupper(substr(bin2hex(random_bytes(3)), 0, 5)),
            'product_name' => $this->faker->words(1, true),
            'product_group' => $this->faker->randomElement([
                'Neo',
                'Trinity',
                'Morpheus',
                'Smith',
                'Cypher',
            ]),
            'expiration_date' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
            
        ];
    }
}
