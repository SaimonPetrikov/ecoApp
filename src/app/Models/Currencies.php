<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';

    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
        'is_virtual',
        'symbol',
        'decimal_places',
    ];

    protected $casts = [
        'is_virtual' => 'boolean',
    ];

    // Связь с балансами
    public function balances()
    {
        return $this->hasMany(UserBillingBalance::class, 'currency_code', 'code');
    }

    // Связь с транзакциями
    public function transactions()
    {
        return $this->hasMany(BillingTransaction::class, 'currency_code', 'code');
    }
}