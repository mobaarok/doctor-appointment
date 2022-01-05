<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class VisitDayTimeRepo
{

    public function store($request)
    {
        if ($request->visit_type == "m") {
            $query = array_merge($this->commonItem($request), $this->morning($request));
            DB::table('doctor_sit_datetimes')->insert($query);
        } elseif ($request->visit_type == "e") {
            $query = array_merge($this->commonItem($request), $this->evening($request));
            DB::table('doctor_sit_datetimes')->insert($query);
        } elseif ($request->visit_type == "b") {
            $query = array_merge($this->commonItem($request), $this->morning_evening($request));
            DB::table('doctor_sit_datetimes')->insert($query);
        } elseif ($request->visit_type == "d") {
            $query = array_merge($this->commonItem($request), $this->fullday($request));
            DB::table('doctor_sit_datetimes')->insert($query);
        }
    }

    protected function commonItem($request)
    {
        return [
            "hospital_id" => $request->hospital_id,
            "doctor_id" => $request->doctor_id,
            "bar" => $request->bartime,
            "shift_type" => $request->visit_type,
        ];
    }

    protected function morning($request)
    {
        return [
            "start_time" => $request->m_start_time,
            "end_time" => $request->m_end_time,
        ];
    }

    protected function evening($request)
    {
        return [
            "evening_start_time" => $request->e_start_time,
            "evening_end_time" => $request->e_end_time,
        ];
    }

    protected function fullday($request)
    {
        return [
            "day_start_time" => $request->d_start_time,
            "day_end_time" => $request->d_end_time,
        ];
    }

    protected function morning_evening($request)
    {
        return [
            "start_time" => $request->m_start_time,
            "end_time" => $request->m_end_time,
            "evening_start_time" => $request->e_start_time,
            "evening_end_time" => $request->e_end_time,
        ];
    }

    public function update($request)
    {
        $success =  DB::table('doctor_sit_datetimes')
            ->where('id', $request->bartime_id)
            ->update([
                "hospital_id" => $request->hospital_id,
                "doctor_id"   => $request->doctor_id,
                "bar"         => $request->bartime,
                "shift_type"  => $request->visit_type,
                "start_time"  => $request->m_start_time,
                "end_time"    => $request->m_end_time,
                "evening_start_time"  => $request->e_start_time,
                "evening_end_time"    => $request->e_end_time,
                "day_start_time"  => $request->d_start_time,
                "day_end_time"    => $request->d_end_time,
            ]);
        return $success;
    }
}
//if we use to query all column in table, it can be geting insert wrong data somehow
// *
// DB::table('doctor_sit_datetimes')->insert([
//     "hospital_id" => $request->hospital_id,
//     "doctor_id"   => $request->doctor_id,
//     "bar"         => $request->bartime,
//     "shift_type"  => $request->visit_type,
//     "start_time"  => $request->m_start_time,
//     "end_time"    => $request->m_end_time,
//     "evening_start_time"  => $request->e_start_time,
//     "evening_end_time"    => $request->e_end_time,
//     "day_start_time"  => $request->d_start_time,
//     "day_end_time"    => $request->d_end_time,
// ]);
