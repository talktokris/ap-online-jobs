<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    public function country_data(){
        return $this->belongsTo(Country::class, 'company_country');
    }

    public function state_data(){
        return $this->belongsTo(State::class, 'company_state');
    }
    public function city_data(){
        return $this->belongsTo(City::class, 'company_city');
    }
    public function emp_profile(){
        return $this->hasMany(EmployerProfile::class);
    }
    
}
