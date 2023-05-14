<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{

    public function offer()
    {

        return $this->belongsTo(Offer::class);

    }

    public function gw_dm()
    {

        return $this->belongsTo(User::class, 'user_id');

    }
    
}
