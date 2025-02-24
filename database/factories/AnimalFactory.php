<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * @var list<string>
     */
    // TODO: Refactor to be the 'species' table and create associations
    private array $petStoreAnimals = [
        'Dog',
        'Cat',
        'Hamster',
        'Guinea Pig',
        'Rabbit',
        'Gerbil',
        'Mouse',
        'Rat',
        'Parakeet',
        'Cockatiel',
        'Finch',
        'Canary',
        'Goldfish',
        'Betta',
        'Guppy',
        'Molly',
        'Platy',
        'Tetra',
        'Angelfish',
        'Corydoras',
        'Leopard Gecko',
        'Bearded Dragon',
        'Corn Snake',
        'Ball Python',
        'Frog',
        'Turtle',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'species' => $this->faker->randomElement($this->petStoreAnimals),
            'breed' => $this->faker->word,
            'age' => $this->faker->numberBetween(1, 20),
            'description' => $this->faker->sentences(4, true),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'image' => 'https://placecats.com/400/260',
            'available' => $this->faker->boolean,
        ];
    }
}
