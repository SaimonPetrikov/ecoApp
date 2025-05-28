<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBillingBalance extends Model
{
    use HasFactory;

    protected $table = 'user_billing_balance';

    protected $fillable = [
        'user_id',
        'currency_code',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с валютой (если есть таблица currencies)
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    // Связь с транзакциями
    public function transactions()
    {
        return $this->hasMany(BillingTransaction::class, 'user_billing_id');
    }
}