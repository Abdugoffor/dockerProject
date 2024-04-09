<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelProductOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'model_product_id',
        'product_stok_id',
        'count',
        'lose',
        'successful',
        'defective',
        'status', // 1 - kelib tushdi, 2 - qabul qilindi, 3 - yakunlandi,
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Applications::class);
    }

    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }

    public function product_stok(): BelongsTo
    {
        return $this->belongsTo(ProductStok::class);
    }

    public function product_productions(): HasMany
    {
        return $this->hasMany(ProductProduction::class);
    }
    

    public function order_users(): HasMany
    {
        return $this->hasMany(OrderUser::class);
    }

    public function equipment_users(): HasMany
    {
        return $this->hasMany(EquipmentUser::class);
    }

    public function product_stok_values(): HasMany
    {
        return $this->hasMany(ProductStokValue::class);
    }
}
