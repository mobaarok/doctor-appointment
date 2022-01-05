<?php

namespace App\Repositories;

use App\Model\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DoctorRepository
{
    public function create($doctorData)
    {
        $doctor = new Doctor;
        $doctor->doctor_name = $doctorData->doctor_name;
        $doctor->email = $doctorData->email;
        $doctor->designation = $doctorData->designation;
        $doctor->save();

        $doc_id = $doctor->id;

        foreach ($doctorData->degree_name as $key => $val) {
            DB::table('doctor_qualifications')->insert([
                'doctor_id' => $doc_id,
                'degree_id' => $doctorData->degree_name[$key],
                'institute_id' => $doctorData->institute_name[$key],
            ]);
        }

        foreach ($doctorData->expertise_name as $key => $val) {
            DB::table('doctors_expertises')->insert([
                'doctor_id' => $doc_id,
                'expertise_id' => $doctorData->expertise_name[$key],

            ]);
        }

        return $doctor;
    }

    public function getDoctorInFeniForHome()
    {
        return Doctor::with([
            'expertises',
            'qualifications.degree',
            'qualifications.institute',
            'hospitals'
        ])->whereHas('hospitals', function (Builder $query) {
            $query->where('district_id', '=', 20);
        })->limit(15)
            ->get();
    }

    public function getDoctorById($doctor_id) {
        return  Doctor::find($doctor_id);
    }

    public function getAllDoctors()
    {
        return Doctor::paginate(10);
    }
}
