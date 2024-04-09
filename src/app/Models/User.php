<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function material_stok(): HasOne
    {
        return $this->hasOne(MaterialStok::class);
    }

    public function product_productions(): HasMany
    {
        return $this->hasMany(ProductProduction::class);
    }

    public function order_users(): HasMany
    {
        return $this->hasMany(OrderUser::class);
    }

    public function product_stok(): HasMany
    {
        return $this->hasMany(ProductStok::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Applications::class);
    }

    public function staf(): HasOne
    {
        return $this->hasOne(UserStaf::class);
    }
}
