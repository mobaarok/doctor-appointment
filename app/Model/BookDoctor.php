<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookDoctor extends Model
{
    protected $table = 'booking_doctor';

    public function doctor()
    {
        return $this->belongsTo('App\Model\Doctor');
    }

    public function hospital()
    {
        return $this->belongsTo('App\Model\Hospital');
    }

    protected $casts = [
        'booking_date' => 'datetime',
        'booking_hours' => 'datetime:H:i:s',
    ];

}
