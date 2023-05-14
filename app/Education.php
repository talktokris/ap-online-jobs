<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function education_level_data(){
        return $this->belongsTo(EducationLevel::class, 'education_level');
    }
}
