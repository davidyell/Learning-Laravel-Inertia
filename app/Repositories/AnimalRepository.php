<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Animal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AnimalRepository
{
    public function findAllPaginated(Request $request): LengthAwarePaginator
    {
        return Animal::withFilterAndSort()
            ->withSpecies()
            ->paginate($request->input('perPage', 15))
            ->withQueryString();
    }

    public function findAllAvailablePaginated(Request $request): LengthAwarePaginator
    {
        return Animal::withFilterAndSort()
            ->withSpecies()
            ->isAvailable()
            ->paginate($request->input('perPage', 15))
            ->withQueryString();
    }

    public function findOne(int $id): Animal
    {
        return Animal::withSpecies()
            ->findOrFail($id);
    }
}
