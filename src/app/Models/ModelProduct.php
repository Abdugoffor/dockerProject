<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_size',
        'size',
        'price',
    ];

    public function model_structures(): HasMany
    {
        return $this->hasMany(ModelStructure::class);
    }

    public function getSummAttribute()
    {
        return $this->model_structures->sum(function ($structure) {
            return $structure->value * $structure->material->price;
        });
    }

    public function model_product_orders(): HasMany
    {
        return $this->hasMany(ModelProductOrder::class);
    }

    public function model_images(): HasMany
    {
        return $this->hasMany(ModelImage::class);
    }

    public function product_productions(): HasMany
    {
        return $this->hasMany(ProductProduction::class);
    }

    public function product_logs(): HasMany
    {
        return $this->hasMany(ProductLog::class);
    }

    public function product_stok_value(): HasMany
    {
        return $this->hasMany(ProductStokValue::class);
    }

    public function application_model_products(): HasMany
    {
        return $this->hasMany(ApplicationModelProduct::class);
    }

    public function delivery_bot(): HasMany
    {
        return $this->hasMany(DeliveryBot::class);
    }
}
