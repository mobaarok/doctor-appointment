<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";


    public function hospitals()
    {
        return $this->belongsToMany('App\Model\Hospital', 'doctors_in_hospitals');
    }

    public function expertises()
    {
        return $this->belongsToMany('App\Model\Expertise', 'doctors_expertises');
    }


    public function visitHour()
    {
        return $this->hasMany('App\Model\VisitHour', 'doctor_id', 'id');
    }

    public function qualifications()
    {
         return $this->hasMany('App\Model\DoctorQualification', 'doctor_id', 'id');
        
    }

    public function expert()
    {
        return $this->hasMany('App\Model\DoctorExpertise', 'doctor_id', 'id');
    }
}
