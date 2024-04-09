<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary_Type_Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'staf_id',
        'type_id',
        'date',
        'value',
        'comment',
    ];

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'staf_id', 'id');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
