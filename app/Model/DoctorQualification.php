<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DoctorQualification extends Model
{
    protected $table = "doctor_qualifications";

    public function degree()
    {
        return $this->belongsTo('App\Model\DoctorDegree');
    }

    public function institute()
    {
        return $this->belongsTo('App\Model\DoctorInstitute');
    }
}
