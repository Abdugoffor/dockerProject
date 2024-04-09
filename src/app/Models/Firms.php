<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Firms extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'prone1',
        'prone2',
        'lang',
        'long',
        'status',
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Applications::class, 'id', 'firm_id');
    }

    public function debtors(): HasMany
    {
        return $this->hasMany(Debtor::class,'firm_id', 'id');
    }
    public function test()
    {
        return $this->debtors()->sum('summ');
    }
}
