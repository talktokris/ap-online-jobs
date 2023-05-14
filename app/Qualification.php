<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    public function graduation_day(){

        return date('d', strtotime($this->graduation_date));

    }

    public function graduation_month(){

        return date('m', strtotime($this->graduation_date));

    }

    public function graduation_year(){

        return date('Y', strtotime($this->graduation_date));

    }
}
