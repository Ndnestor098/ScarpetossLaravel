<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->words(3, true),
            "description" => $this->faker->text(),
            "price" => $this->faker->numberBetween(10,300),
            "gender" => $this->faker->randomElement(['mujer', 'hombre', 'niño', 'unisex']),
            "imageP" => $this->faker->randomElement(['images/66537f0c06ab0.webp', 'images/6653803d8745d.webp', 'images/6648df9306523.webp', 'images/6648dfccca5d4.webp', 'images/6648ddc941a35.webp']),
            "imageA" => $this->faker->randomElement(['images/66537f0c06ab0.webp', 'images/6653803d8745d.webp', 'images/6648df9306523.webp', 'images/6648dfccca5d4.webp', 'images/6648ddc941a35.webp']),
            "stock" => $this->faker->numberBetween(50,150),
            "brand" => $this->faker->company(),
        ];
    }
}
