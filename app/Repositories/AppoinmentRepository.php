<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppoinmentRepository
{
    public function create($appoinmentData)
    {
        // Carbon::parse("22-March-2021"); this and
        // Carbon::parse("Monday 22-March-2021"); can parse as date like "2021-03-22"
        // $dt = Carbon::now()->toTimeString(); // 13:12:0
        $given_appoinment_date = Carbon::parse($appoinmentData->appoinment_date);
        /*
        Get this doctor watch time from default db time
         */
        $watch_minute = DB::table('doctor_watch_time')->where([
            ['hospital_id', '=', $appoinmentData->hospital_id],
            ['doctor_id', '=', $appoinmentData->doctor_id],
        ])->first()->doctor_watch_time;
        // end

        $lastBookingTime = $this->lastBookingTime($appoinmentData, $given_appoinment_date);
        //this block
        $doctorVisitStartTimeCollection = $this->doctorVisitStartTimeFromDB($appoinmentData, $given_appoinment_date);
        $doctor_booking_start_time = $this->appoinmentTimeSelectByShiftType($appoinmentData->shift_type, $doctorVisitStartTimeCollection);
        // end block
        // dd($appoinmentData->all());

        //jodi last book time thake 1st one, na thakle 2nd block
        if ($lastBookingTime) {
            $createBookingHour = Carbon::create($lastBookingTime->booking_hours);
        } else {
            $createBookingHour = Carbon::create($doctor_booking_start_time);
        }
        $final_booking_hours = $createBookingHour->addMinutes($watch_minute);

        //  generate serial number
        $last_serial_number = $this->getLastSerialNumber($appoinmentData);
        if ($last_serial_number) {
            $final_serial_number = $last_serial_number->serial_number + 1;
        } else {
            $final_serial_number = 1;
        }

        $appoinment = DB::table('booking_doctor')->insertGetId([
            'hospital_id' => $appoinmentData->hospital_id,
            'doctor_id' => $appoinmentData->doctor_id,
            'patient_name' => $appoinmentData->paitent_name,
            'patient_age' => $appoinmentData->patient_age,
            'booking_date' => Carbon::parse($appoinmentData->appoinment_date),
            'booking_hours' => $final_booking_hours->toTimeString(),
            'patient_phone' => $appoinmentData->mobile,
            'user_id' => $appoinmentData->user_id,
            'booking_id' => Str::random(4),
            'serial_number' => $final_serial_number,
            'created_at' => Carbon::now(),
        ]);
        return $appoinment;
    }

    private function doctorVisitStartTimeFromDB($appoinmentData, $given_appoinment_date)
    {
        // get present dayname  doctor sit time
        $given_appoinment_dayname = $given_appoinment_date->dayName;

        $doctorVisitStartTime = DB::table('doctor_sit_datetimes')
            ->where([
                ['doctor_id', $appoinmentData->doctor_id],
                ['hospital_id', $appoinmentData->hospital_id],
                ['bar', $given_appoinment_dayname],
            ])
            ->first();
        return $doctorVisitStartTime;
    }

    private function lastBookingTime($appoinmentData, $given_appoinment_date)
    {
        $lastBookingTime = DB::table('booking_doctor')->where([
            ['hospital_id', '=', $appoinmentData->hospital_id],
            ['doctor_id', '=', $appoinmentData->doctor_id],
            ['booking_date', '=', $given_appoinment_date],
        ])->latest()->first();
        return $lastBookingTime;
    }

    private function appoinmentTimeSelectByShiftType($shift_type, $doctorVisitStartTimeCollection)
    {
        if ($shift_type == "m") {
            return $doctorVisitStartTimeCollection->start_time;
        } elseif ($shift_type == "e") {
            return $doctorVisitStartTimeCollection->evening_start_time;
        } elseif ($shift_type == "d") {
            return $doctorVisitStartTimeCollection->day_start_time;
        }
    }

    private function getLastSerialNumber($appoinmentData)
    {
        $lastBookingItem = DB::table('booking_doctor')->where([
            ['hospital_id', '=', $appoinmentData->hospital_id],
            ['doctor_id', '=', $appoinmentData->doctor_id],
            ['booking_date', '=', Carbon::parse($appoinmentData->appoinment_date)],
        ])->latest()->first();

        return $lastBookingItem;
    }

}
