<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staf extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'adres',
        'img',
        'file',
        'working_time',
        'sum',
        'hourly',
        'department_id',
        'salary__type_id',
        // 'position_id',
        'status',
        'text',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function salary(): HasMany
    {
        return $this->hasMany(Salary_Type_Value::class);
    }

    public function fines(): HasMany
    {
        return $this->hasMany(Fines::class);
    }

    public function salary_type(): BelongsTo
    {
        return $this->belongsTo(Salary_Type::class, 'salary__type_id', 'id');
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_stafs'); // "equipment_staf" jadvalini aniqlang
    }

    public function salarys(): HasMany
    {
        return $this->hasMany(Salary_Type::class);
    }

    public function couriers(): HasMany
    {
        return $this->hasMany(Courier::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(UserStaf::class);
    }

    // public function tabels(): HasMany
    // {
    //     return $this->hasMany(Tabel::class);
    // }

    public function dateTabels(): HasMany
    {
        return $this->hasMany(Tabel::class);
    }
    public function salarySum()
    {
        return $this->dateTabels()->sum('date');
    }
}
