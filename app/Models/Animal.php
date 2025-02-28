<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class Animal
 *
 * @property int $id
 * @property string $name
 * @property string $species
 * @property string|null $breed
 * @property int|null $age
 * @property string|null $description
 * @property float|null $price
 * @property string|null $image
 * @property bool $available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Animal extends Model
{
    /** @use HasFactory<\Database\Factories\AnimalFactory> */
    use HasFactory;

    /** @var List<string> */
    public $fillable = [
        'name',
        'age',
        'species_id',
        'breed',
        'description',
        'image',
        'price',
        'available',
    ];

    /**
     * Get the species of the animal.
     *
     * @return BelongsTo<Species, $this>
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function scopeWithFilterAndSort(Builder|Relation|string $query): QueryBuilder
    {
        return QueryBuilder::for($query)
            ->allowedFilters('name', AllowedFilter::belongsTo('species', 'species'), 'breed', 'available')
            ->allowedSorts('updated_at')
            ->defaultSort('name');
    }

    public function scopeWithSpecies(Builder $query)
    {
        return $query->with('species');
    }
}
