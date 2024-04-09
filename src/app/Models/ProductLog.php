<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', // 1 ishlab chiqarib yuborildi, 2 transfer
        'increment', // 1 qo'shilish, 2 ayirilish
        'model_product_id',
        'quantity',
        'went', // nechta edi 
        'remained', // nechta qoldi
        'from_id',
        'to_id',
    ];

    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }

    public function from_stok(): BelongsTo
    {
        return $this->belongsTo(ProductStok::class, 'from_id', 'id');
    }

    public function to_stok(): BelongsTo
    {
        return $this->belongsTo(ProductStok::class, 'to_id', 'id');
    }
}
