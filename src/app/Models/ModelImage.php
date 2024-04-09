<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_product_id',
        'img',
    ];

    public function model_product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class);
    }
}
