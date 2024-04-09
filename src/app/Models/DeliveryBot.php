<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryBot extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'count',
        'courier_id',
        'lang',
        'long',
        'status',
    ];

    public function apllication(): BelongsTo
    {
        return $this->belongsTo(Applications::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }
}
