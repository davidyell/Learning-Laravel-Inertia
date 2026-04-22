<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnimalRequest;
use App\Models\Animal;
use App\Models\Species;
use App\Repositories\AnimalRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PetsController extends Controller
{
    public function __construct(
        private AnimalRepository $animalRepo
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Pets/Index', [
            'animals' => $this->animalRepo->findAllPaginated($request),
            'species' => Species::orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Pets/Create', [
            'animal' => new Animal,
            'species' => Species::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $animal = new Animal;
        $animal->fill($request->validated());
        $animal->save();

        return redirect(route('pets.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnimalRequest $request, Animal $animal)
    {
        $animal->update($request->validated());

        return redirect(route('pets.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
