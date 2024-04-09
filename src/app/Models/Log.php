<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', // 1 prixod, 2 transfer
        'increment', // 1 qo'shilish, 2 ayirilish
        'material_id',
        'quantity',
        'went', // nechta edi ,
        'remained', // nechta qoldi,
        'from_id',
        'to_id',
    ];

    public function from(): BelongsTo
    {
        return $this->belongsTo(MaterialStok::class, 'from_id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(MaterialStok::class, 'to_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
