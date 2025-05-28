<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';
    case PAYMENT = 'payment';
    case REFUND = 'refund';
    case TRANSFER = 'transfer';
    
    public function label(): string
    {
        return match($this) {
            self::DEPOSIT => 'Пополнение',
            self::WITHDRAWAL => 'Списание',
            self::PAYMENT => 'Оплата',
            self::REFUND => 'Возврат',
            self::TRANSFER => 'Перевод',
        };
    }
}