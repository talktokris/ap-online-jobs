<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }
    public function EmployerProfile()
    {
        return $this->belongsTo(EmployerProfile::class);
    }
}
