<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
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
        return Inertia::render('Animals/Create', [
            'animal' => new Animal,
            'species' => \App\Models\Species::orderBy('name')->get(),
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

        return redirect(route('animals.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnimalRequest $request, Animal $animal)
    {
        $animal->update($request->validated());

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
