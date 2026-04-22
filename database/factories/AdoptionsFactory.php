<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Adoptions;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Adoptions>
 */
class AdoptionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'notes' => $this->faker->paragraph(),
            'approved' => $this->faker->boolean(),
            'animal_id' => Animal::factory(),
            'user_id' => User::factory(),
            'approved_by_id' => User::factory(),
        ];
    }
}
