<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductStok extends Model
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

    public function model_product_orders(): HasMany
    {
        return $this->hasMany(ModelProductOrder::class);
    }

    public function product_stok_values(): HasMany
    {
        return $this->hasMany(ProductStokValue::class);
    }

    public function from():HasMany
    {
        return $this->hasMany(ProductLog::class,'from_id','id');
    }

    public function to():HasMany
    {
        return $this->hasMany(ProductLog::class,'to_id','id');
    }
}
