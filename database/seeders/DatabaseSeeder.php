<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Species;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'admin@example.com')->first();

        if ($user === null) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $this->call([
            // Seed species first, so the animal.species_id foreign key constraint is satisfied
            SpeciesSeeder::class,
            AnimalSeeder::class,
        ]);
    }
}
