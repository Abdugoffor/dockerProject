<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelStructure extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_product_id',
        'material_id',
        'unit',
        'value',
    ];

    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
    
}
