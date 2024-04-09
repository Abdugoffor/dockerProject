<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rashod extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', // 1- kirim, 2 - chiqim
        'type_sum',  // 1 - sum, 2 - plastik karta, 3 - perechesleniya, 4 - do'llor
        'application_id',
        'nakladnoy_id',
        'boshqa',
        'sum',
        'kurs',
        'text',
    ];

    public function getTypeSumAttribute()
    {
        switch ($this->attributes['type_sum']) {
            case 1:
                return 'Сум';
                break;
            case 2:
                return 'Карта';
                break;
            case 3:
                return 'Перечесление';
                break;
            case 4:
                return 'Доллар';
                break;
            default:
                return 'noma\'lum';
        }
    }


    public function application(): BelongsTo
    {
        return $this->belongsTo(Applications::class);
    }

    public function nakladnoy(): BelongsTo
    {
        return $this->belongsTo(Nakladnoy::class);
    }
}
