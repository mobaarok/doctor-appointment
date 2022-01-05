<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Hospital extends Authenticatable
{
    use Notifiable;

     /**
     * The table name define.
     *
     * @var variable
     */
    protected $table = "hospitals";
    // protected $guarded = [];

    protected $guarded = [];

        protected $hidden = [
        'password', 'remember_token', 'email_verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'hospital_open_time' => 'datetime:H:i:s',
        'hospital_closing_time' => 'datetime:H:i:s',
        'activated_at' => 'datetime'
    ];

  public function doctors()
  {
      return $this->belongsToMany('App\Model\Doctor', 'doctors_in_hospitals', 'hospital_id', 'doctor_id');
  }

    public function division()
    {
        return $this->belongsTo('App\Model\Division', 'division_id');
        
    }

    public function district()
    {
        return $this->belongsTo('App\Model\District', 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo('App\Model\Upazila', 'upazila_id');
    }

   


}
