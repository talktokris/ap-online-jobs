<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function user_role()
    {
        return $this->belongsTo(User::class);
    }
}
