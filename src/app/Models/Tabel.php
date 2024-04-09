<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tabel extends Model
{
    use HasFactory;
    protected $fillable = [
        'staf_id',
        'date',
        'stavka',
        'how_many',
        'clock',
    ];

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class);
    }
}
