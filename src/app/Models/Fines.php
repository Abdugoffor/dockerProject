<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fines extends Model
{
    use HasFactory;
    protected $fillable = [
        'staf_id',
        'date',
        'valeu',
        'comment',
    ];

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'staf_id', 'id');
    }
}
