<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = Species::all();

        // Use the state with the a sequence to ensure that each animal has a different species_id
        Animal::factory(50)->state(new Sequence(
            fn () => ['species_id' => $species->random()->id]
        ))->create();
    }
}
