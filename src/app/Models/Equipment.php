<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function stafs()
    {
        return $this->belongsToMany(Staf::class, 'equipment_stafs'); // "equipment_staf" jadvalini aniqlang
    }

    public function equipment_users(): HasMany
    {
        return $this->hasMany(EquipmentUser::class);
    }

    public function product_productions(): HasMany
    {
        return $this->hasMany(ProductProduction::class);
    }
}
