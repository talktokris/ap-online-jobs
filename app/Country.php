<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
