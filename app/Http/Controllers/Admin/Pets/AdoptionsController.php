<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Pets;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Animal;
use App\Notifications\PetAdoptionNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdoptionsController extends Controller
{
    /**
     * Approve a client to adopt a pet
     *
     * @throws ModelNotFoundException When the adoption application is not found
     * @throws HttpException A 400 when trying to adopt a pet which is not available
     */
    public function approve(string $animalId, string $adoptionId): RedirectResponse
    {
        $adoption = Adoption::with(['animal', 'user', 'approver'])->findOrFail($adoptionId);
        if (! $adoption->animal->available) {
            abort(400, 'Pet is not available for adoption');
        }

        DB::transaction(function () use ($adoption) {
            $adoption->animal->available = false;
            $adoption->animal->save();

            $adoption->approved = true;
            $adoption->approved_by_id = Auth::user()->id;
            $adoption->save();

            $email = new PetAdoptionNotification($adoption);
            $adoption->user->notify($email);
        });

        return to_route(route('admin.pets.adoptions.show', $adoption->animal));
    }

    public function show(Animal $animal): Response
    {
        $animal = $animal->load([
            'adoptions' => [
                'user',
                'approver',
            ],
            'species',
        ]);
        $animal->adoptions->sortByDesc('updated_at');

        return Inertia::render('Admin/Pets/Adoptions/Index', [
            'animal' => $animal,
        ]);
    }
}
