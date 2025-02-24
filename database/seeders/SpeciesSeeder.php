<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * @var list<string>
     */
    public static array $species = [
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
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$species as $speciesName) {
            Species::factory()->create(['name' => $speciesName]);
        }
    }
}
