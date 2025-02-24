<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Animal;
use App\Models\Species;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AnimalControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_animals()
    {
        $species = Species::factory()->create();

        Animal::factory()
            ->for($species)
            ->count(5)
            ->create();
        $this->assertDatabaseCount(Animal::class, 5);

        $this->actingAs(User::factory()->create());
        $response = $this->get(route('animals.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Animals/Index')
            ->has('animals.data', 5)
        );

    }
}
