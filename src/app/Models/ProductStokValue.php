<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductStokValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_stok_id',
        'model_product_id',
        'value',
    ];

    public function product_stok(): BelongsTo
    {
        return $this->belongsTo(ProductStok::class);
    }
    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }
}
