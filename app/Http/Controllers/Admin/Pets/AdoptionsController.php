<?php

namespace App\Http\Controllers\Admin\Pets;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AdoptionsController extends Controller
{
    /**
     * Approve a client to adopt a pet
     *
     * @return void
     */
    public function approve(Animal $animal)
    {
        $animal->setAttribute('approved', true);
        $animal->setAttribute('approved_by_id', Auth::getUser());
    }

    public function show(Animal $animal): Response
    {
        $animal = $animal->load([
            'adoptions' => [
                'user'
            ],
            'species'
            ]);
        $animal->adoptions->sortByDesc('updated_at');

        return Inertia::render('Admin/Pets/Adoptions/Index', [
            'animal' => $animal
        ]);
    }
}
