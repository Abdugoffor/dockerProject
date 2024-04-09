<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'slug',
    ];
    public function material_stok_values(): HasOne
    {
        return $this->hasOne(MaterialStokValue::class);
    }
    public function prixods(): HasMany
    {
        return $this->hasMany(Prixod::class);
    }
}
