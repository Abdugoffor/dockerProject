<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone1',
        'phone2',
        'balans',
        'status',
    ];

    public function firms(): HasMany
    {
        return $this->hasMany(Firms::class);
    }
    
    public function applications(): HasMany
    {
        return $this->hasMany(Applications::class);
    }
}
