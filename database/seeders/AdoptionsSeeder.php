<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Adoptions;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AdoptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection<Animal> */
        $animals = Animal::where('available', true)->get();

        /** @var Collection<User> */
        $users = User::all();

        Adoptions::factory(10)
            ->state(new Sequence(
                fn () => [
                    'animal_id' => $animals->random()->id,
                    'user_id' => $users->random()->id,
                    'approved' => $approved = fake()->boolean(),
                    'approved_by_id' => $approved ? $users->random()->id : null,
                ]
            ))
            ->create();
    }
}
