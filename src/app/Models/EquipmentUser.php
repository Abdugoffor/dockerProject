<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_id',
        'order_user_id',
        'model_product_order_id',
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function order_user(): BelongsTo
    {
        return $this->belongsTo(OrderUser::class);
    }

    public function model_product_order(): BelongsTo
    {
        return $this->belongsTo(ModelProductOrder::class);
    }
}
