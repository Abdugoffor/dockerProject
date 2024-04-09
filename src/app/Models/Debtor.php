<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'firm_id',
        'summ',
    ];

    public function application()
    {
        return $this->belongsTo(Applications::class);
    }

    public function firma()
    {
        return $this->belongsTo(Firms::class, 'firm_id','id');
    }
}
