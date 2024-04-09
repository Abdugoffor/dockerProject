<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialStok extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function material_stok_values(): HasMany
    {
        return $this->hasMany(MaterialStokValue::class);
    }
    public function qolgani()
    {
        return $this->material_stok_values()->where('quantity', '>', 10);
    }

    public function from(): HasMany
    {
        return $this->hasMany(Log::class, 'from_id');
    }

    public function to(): HasMany
    {
        return $this->hasMany(Log::class, 'to_id');
    }
}
