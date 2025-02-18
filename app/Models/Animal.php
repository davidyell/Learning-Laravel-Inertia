<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
