<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlueWorkerEducation extends Model
{
    protected $table = 'blue_worker_education';
    protected $guarded = ['id'];

    public function education_level_data(){
        return $this->belongsTo(EducationLevel::class, 'education_level');
    }
}
