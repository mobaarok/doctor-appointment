<?php

namespace App\Repositories;

use App\Model\DoctorDegree;
use App\Model\DoctorInstitute;
use Illuminate\Support\Facades\DB;

class DoctorEducationRepository
{
    public function createDegree($request)
    {

        foreach ($request->degree_st_name as $key => $value) {
            DB::table('doctor_degrees')->insert([
                "degree_short_name" => $request->degree_st_name[$key],
                "degree" => $request->degree[$key],
            ]);
        }

    }

    public function updateDegree($request, $id)
    {
        $degree = DoctorDegree::find($id);
        $degree->degree_short_name = $request->degree_short_name;
        $degree->degree = $request->degree;
        $degree->save();
        return $degree;
    }

    public function createInstitute($request)
    {
        foreach ($request->institute_st_name as $key => $value) {
            DB::table('doctor_institutes')->insert([
                "institute_short_name" => $request->institute_st_name[$key],
                "institute" => $request->institute[$key],
            ]);
        }

    }

    public function updateInstitute($request, $id)
    {
        $institute = DoctorInstitute::find($id);
        $institute->institute_short_name = $request->institute_short_name;
        $institute->institute = $request->institute;
        $institute->save();
        return $institute;

    }
}
