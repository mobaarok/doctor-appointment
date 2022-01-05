<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Division;
use App\Model\Doctor;
use App\Model\Hospital;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function division()
    {
        $divisions = Division::get();
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'All division list',
            'data' => ['divisions' => $divisions],
        ]);
    }

    public function getDistrictByDivisionId($id)
    {
        $districts = DB::table('districts')->where('division_id', $id)->get();
        // District::get()->where('division_id', $id);
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'All district list by selected division',
            'data' => ['districts' => $districts],
        ]);
    }

    public function getCityByDistrictId($id)
    {
        $cities = DB::table('upazilas')->where('district_id', $id)->get();
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'All cities/upazila list by selected distircts',
            'data' => ['cities' => $cities],
        ]);

    }

    public function getDoctorAndHospitalByCity($city_id)
    {
        // $hospitals = Hospital::with([
        //     'doctors.qualifications.degree',
        //     'doctors.qualifications.institute',
        //     'doctors.expertises.expertise',
        // ])->where('hospitals.upazila', $city_id)->get();
        // $doctorList = [];
        // foreach ($hospitals as $hospital) {
        //     foreach ($hospital->doctors as $doctor) {
        //         $doctorList[$doctor->doctor_name] = $doctor;
        //     }
        //     unset($hospital->doctors);
        // }
        $hospitals = Hospital::where('upazila', $city_id)->get();
        $doctors = Doctor::with([
            'qualifications.degree',
            'qualifications.institute',
            'expertises.expertise',
        ])->whereHas('hospitals', function (Builder $query) use ($city_id) {
            $query->where('upazila', '=', $city_id);
        })->get();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'All doctors and hosipital by selected city',
            'data' => ['hospitals' => $hospitals, 'doctors' => $doctors],
        ]);
    }

    public function getHospitalById($id)
    {
        $hospitalWithDoctor = Hospital::with([
            'doctors.qualifications.degree',
            'doctors.qualifications.institute',
            'doctors.expertises.expertise',
        ])->find($id);
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Selected hospital and its doctors list',
            'data' => ['hospitals' => $hospitalWithDoctor],
        ]);
    }

    public function getDoctorById($id)
    {
        $doctor = Doctor::with([
            'qualifications.degree',
            'qualifications.institute',
            'expertises.expertise',
        ])->find($id);

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Single doctor by selected id',
            'data' => ['doctor' => $doctor],
        ]);

    }

}
