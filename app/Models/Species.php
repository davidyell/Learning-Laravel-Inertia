<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Species extends Model
{
    /** @use HasFactory<\Database\Factories\SpeciesFactory> */
    use HasFactory;

    /**
     * Get the animals for a specific species
     *
     * @return HasMany<Animal, $this>
     */
    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
