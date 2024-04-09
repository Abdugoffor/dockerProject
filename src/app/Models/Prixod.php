<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prixod extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_id',
        'nakladnoy_id',
        'unit',
        'quantity',
        'price',
        'sum',
        // 'term',
    ];
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
    public function nakladnoy(): BelongsTo
    {
        return $this->belongsTo(Nakladnoy::class);
    }
}
