<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_owner_id',
        'product_amount',
        'amount',
    ];

    protected $casts = [
        'product_amount' => 'decimal:2',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'product_owner_id');
    }

    public function billingRecords()
    {
        return $this->hasMany(Billing::class);
    }
}