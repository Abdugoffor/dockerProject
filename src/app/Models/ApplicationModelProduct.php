<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationModelProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'model_product_id',
        'count',
        'status', // 1 - qabul qilindi, 2 - ishlab chiqarish jarayonda ,
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Applications::class,  'application_id');
    }

    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }
}
