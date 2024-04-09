<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary_Type extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    /**
     * Get all of the comments for the Salary_Type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staffs(): HasMany
    {
        return $this->hasMany(Staf::class);
    }

}
