<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStaf extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staf_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'staf_id');
    }
}
