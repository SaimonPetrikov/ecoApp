<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_billing_id',
        'amount',
        'task_id',
        'product_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function userBalance()
    {
        return $this->belongsTo(UserBillingBalance::class, 'user_billing_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}