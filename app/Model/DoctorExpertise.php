<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DoctorExpertise extends Model
{
    protected $table  = "doctors_expertises";
     public function expertise()
     {
       return  $this->belongsTo('App\Model\Expertise');
     }
}
