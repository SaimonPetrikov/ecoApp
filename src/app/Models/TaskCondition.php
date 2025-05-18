<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'is_automative_approve',
        'approve_role_id',
        'conditions',
    ];

    protected $casts = [
        'is_automative_approve' => 'boolean',
        'conditions' => 'array',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function approveRole()
    {
        return $this->belongsTo(Role::class, 'approve_role_id');
    }
}