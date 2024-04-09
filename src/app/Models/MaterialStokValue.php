<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialStokValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_stok_id',
        'material_id',
        'unit',
        'quantity',
    ];
    public function material_stok(): BelongsTo
    {
        return $this->belongsTo(MaterialStok::class);
    }
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
