<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Extends the Spatie Permission package's Role model
    public function taskConditions()
    {
        return $this->hasMany(TaskCondition::class, 'approve_role_id');
    }
}