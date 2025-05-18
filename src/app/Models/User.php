<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function billingBalance()
    {
        return $this->hasOne(UserBillingBalance::class);
    }

    public function ownedProducts()
    {
        return $this->hasMany(Product::class, 'product_owner_id');
    }

    public function transactions()
    {
        return $this->hasManyThrough(Billing::class, UserBillingBalance::class);
    }
}