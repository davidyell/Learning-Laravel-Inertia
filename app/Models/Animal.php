<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'species',
        'breed',
        'description',
        'image',
        'price',
        'available',
    ];
}
