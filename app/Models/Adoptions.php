<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoptions extends Model
{
    /** @use HasFactory<\Database\Factories\AdoptionsFactory> */
    use HasFactory;

    /** @var List<string> */
    public $fillable = [
        'notes',
        'approved'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_id', 'id');
    }
}
