<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DoctorWatchTime extends Model
{
    protected $table = 'doctor_watch_time';

        protected $casts = [
        'doctor_watch_time' => 'integer',
        ];
}
