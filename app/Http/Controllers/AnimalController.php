<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $queryBuilder = QueryBuilder::for(Animal::class)
            ->allowedFilters('name', AllowedFilter::belongsTo('species', 'species'), 'breed', 'available')
            ->allowedSorts('name', 'age', 'species', 'breed', 'price', 'available');

        return Inertia::render('Animals/Index', [
            'animals' => $queryBuilder
                ->with('species')
                ->paginate($request->get('perPage', 15)),
            'species' => \App\Models\Species::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Animals/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        // TODO: Refactor this to a form request to re-use for Create and Update
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'price' => 'required|numeric|min:0',
            'available' => 'required|boolean',
        ]);

        $animal->update($validated);

        return redirect(route('animals.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
