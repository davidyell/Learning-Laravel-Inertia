<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\AdoptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Adoption Model
 * For a user to adopt a pet, there might be many adoption applications per pet.
 *
 * @property Animal $animal
 * @property User $user
 * @property User $approver
 */
class Adoption extends Model
{
    /** @use HasFactory<AdoptionFactory> */
    use HasFactory;

    /** @var List<string> */
    public $fillable = [
        'notes',
        'approved',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_id', 'id');
    }
}
