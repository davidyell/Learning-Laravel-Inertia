<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Species;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PetsController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $animals = Animal::withFilterAndSort()
            ->withSpecies()
            ->paginate($request->get('perPage', 15))
            ->withQueryString();

        return Inertia::render('Pets/Index', [
            'animals' => $animals,
            'species' => Species::orderBy('name')->get(),
        ]);
    }

    // Display the specified resource.
    public function show($id)
    {
        //
    }
}
