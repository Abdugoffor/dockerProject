<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_product_order_id',
        'user_id',
        'status',
    ];

    public function model_product_order(): BelongsTo
    {
        return $this->belongsTo(ModelProductOrder::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function equipment_user():hasMany
    {
        return $this->hasMany(EquipmentUser::class);
    }
}
