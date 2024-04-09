<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentStaf extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_id',
        'staf_id',
    ];

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class);
    }

    public function staf()
    {
        return $this->belongsToMany(Staf::class);
    }
}
