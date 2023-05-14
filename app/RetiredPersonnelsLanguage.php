<?php

namespace App;

use App\Language;
use Illuminate\Database\Eloquent\Model;

class RetiredPersonnelsLanguage extends Model
{
    public function language_name(){
        return Language::where('id', $this->language)->first();
    }
}
