<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingTransaction extends Model
{
    use HasFactory;

    protected $table = 'billing';

    protected $fillable = [
        'user_billing_id',
        'amount',
        'currency_code',
        'transaction_type',
        'description',
        'task_id',
        'product_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_type' => TransactionType::class,
    ];

    // Типы транзакций (можно вынести в отдельный Enum)
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAWAL = 'withdrawal';
    const TYPE_PAYMENT = 'payment';
    const TYPE_REFUND = 'refund';
    const TYPE_TRANSFER = 'transfer';

    public static function getTransactionTypes()
    {
        return [
            self::TYPE_DEPOSIT,
            self::TYPE_WITHDRAWAL,
            self::TYPE_PAYMENT,
            self::TYPE_REFUND,
            self::TYPE_TRANSFER,
        ];
    }

    // Связь с балансом пользователя
    public function userBalance()
    {
        return $this->belongsTo(UserBillingBalance::class, 'user_billing_id');
    }

    // Связь с валютой
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    // Связь с задачей (если есть)
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Связь с продуктом (если есть)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}