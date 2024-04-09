<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductProduction extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_product_order_id',
        'model_product_id',
        'user_id',
        'equipment_id',
        'count',
        'successful',
        'defective',
        'status', // 1 - kelib tushdi, 2 - qabul qilindi, 3 - yakunlandi,
        'start',
    ];

    public function model_product_order(): BelongsTo
    {
        return $this->belongsTo(ModelProductOrder::class);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
