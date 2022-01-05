<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AssignDoctorRepository
{
    public function create($assignData)
    {
        DB::table('doctors_in_hospitals')->insert([
            'hospital_id' => $assignData->hospital_id,
            'doctor_id'   => $assignData->doctor_id,
        ]);

        // foreach ($assignData->bartime as $key => $value) {
        //     DB::table('doctor_sit_datetimes')->insert([
        //         'hospital_id' => $assignData->hospital_id,
        //         'doctor_id'   => $assignData->doctor_id,
        //         'bar'      =>  $assignData->bartime[$key],
        //         'start_time' => $assignData->m_start_time[$key],
        //         'end_time' => $assignData->m_end_time[$key],
        //         'evening_start_time' => $assignData->e_start_time[$key],
        //         'evening_end_time' => $assignData->e_end_time[$key],
        //     ]);
        // }
    }
}
