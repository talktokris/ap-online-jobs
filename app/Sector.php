<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function sub_sectors()
    {
        return $this->hasMany(SubSector::class);
    }
}
