<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobLanguage extends Model
{
    public function language_data(){

        return $this->belongsTo(Language::class, 'language');
        
    }
}
