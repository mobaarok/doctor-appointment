<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VisitHour extends Model
{

    protected $table = 'doctor_sit_datetimes';

   
    // protected $dates = [
    //     'start_time', 'end_time' => 'hh:mm: A',
    // ];


    protected $casts = [
        'start_time' => 'datetime:h:i:s',
        'end_time' => 'datetime:h:i:s',
        'evening_start_time' => 'datetime:h:i:s',
        'evening_end_time'   => 'datetime:h:i:s',
        'day_start_time' => 'datetime:h:i:s',
        'day_end_time'  => 'datetime:h:i:s',
        'hospital_id'  => 'integer',
        'doctor_id'  => 'interger',
    ];
}
