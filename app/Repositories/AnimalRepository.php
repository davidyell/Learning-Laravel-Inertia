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
            ->withCount('adoptions')
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

    /**
     * Find a single animal by it's primary key
     *
     * @param integer $id The id of the animal
     * @param bool $isAvailable Is the pet available or not
     * @return Animal
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException<Animal>
     */
    public function findOne(int $id, bool $isAvailable = false): Animal
    {
        $query = Animal::withSpecies();
        if ($isAvailable) {
            $query->isAvailable();
        }

        return $query->findOrFail($id);
    }
}
