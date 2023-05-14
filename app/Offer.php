<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
    public function preferred_country_data(){
        return $this->belongsTo(Country::class, 'preferred_country');
    }
    public function preferred_country_data2(){
        return $this->belongsTo(Country::class, 'preferred_country2');
    }
    public function preferred_country_data3(){
        return $this->belongsTo(Country::class, 'preferred_country3');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'assigned_agent');
    }

    public function applicants(){
        return $this->hasMany(Applicant::class);
    }
}
