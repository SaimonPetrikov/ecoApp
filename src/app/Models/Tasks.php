<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'available_at',
    ];

    protected $casts = [
        'available_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function conditions()
    {
        return $this->hasMany(TaskCondition::class);
    }

    public function billingRecords()
    {
        return $this->hasMany(Billing::class);
    }
}

