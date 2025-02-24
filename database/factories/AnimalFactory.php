<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'species_id' => $this->faker->randomNumber(),
            'breed' => $this->faker->word,
            'age' => $this->faker->numberBetween(1, 20),
            'description' => $this->faker->sentences(4, true),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'image' => 'https://placecats.com/400/260',
            'available' => $this->faker->boolean,
        ];
    }
}
