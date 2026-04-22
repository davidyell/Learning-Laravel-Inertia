<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Species;
use App\Repositories\AnimalRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PetsController extends Controller
{
    public function __construct(private readonly AnimalRepository $animals) {}

    public function index(Request $request)
    {
        return Inertia::render('Pets/Index', [
            'animals' => $this->animals->findAllAvailablePaginated($request),
            'species' => Species::orderBy('name')->get(),
        ]);
    }

    public function show(int $id)
    {
        $animal = $this->animals->findOne($id);

        return Inertia::render('Pets/Show', [
            'animal' => $animal
        ]);
    }
}
