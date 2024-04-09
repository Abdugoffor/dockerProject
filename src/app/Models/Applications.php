<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applications extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id',
        'firm_id',
        'courier_id',
        // 'type_dastavka',
        'name',
        'description',
        'sum',
        'protsent',
        'payment',
        'debtor',
        'status', // 1-qabul qilindi, 2-adminga yuborildi, 3-ishlab chiqarishga yuborildi, 4-ishlab chiqarish boshlandi, 5-yakunlandi, 6-olib ketgan,7-vazvart-tavar
        'bugalter_status', // 0 - shotfactura shart emas, 1 - bugalterga ko'rinadi,
        'delivery_time',
        'delivery_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function firma(): BelongsTo
    {
        return $this->belongsTo(Firms::class, 'firm_id', 'id');
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    public function application_model_products(): HasMany
    {
        return $this->hasMany(ApplicationModelProduct::class, 'application_id',);
    }

    public function delivery_bot(): HasMany
    {
        return $this->hasMany(DeliveryBot::class);
    }

    public function debtors(): HasMany
    {
        return $this->hasMany(Debtor::class);
    }

    public function model_product_orders(): HasMany
    {
        return $this->hasMany(ModelProductOrder::class);
    }

    public function rashods(): HasMany
    {
        return $this->hasMany(Rashod::class);
    }
}
