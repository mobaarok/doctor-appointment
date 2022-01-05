<?php

namespace App\Repositories;

use App\Model\Hospital;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HospitalRepository
{
    public function register($hospitalData)
    {

        $hospital = new Hospital;
        $hospital->hospital_name = $hospitalData->hospital_name;
        $hospital->email = strtolower(trim($hospitalData->email));
        $hospital->password = bcrypt($hospitalData->password);
        $hospital->mobile_phone = $hospitalData->mobile_phone;
        $hospital->email_verification_token = Str::random(30);
        $hospital->save();

        return $hospital;
    }

    public function update($hospitalData, $id)
    {

        $hospital = Hospital::find($id);
        $hospital->hospital_name = $hospitalData->hospital_name;
        $hospital->username = $hospitalData->username;
        $hospital->mobile_phone = $hospitalData->mobile_phone;
        $hospital->telephone = $hospitalData->telephone;
        $hospital->optional_title = $hospitalData->optional_title;
        $hospital->division_id = $hospitalData->division;
        $hospital->district_id = $hospitalData->district;
        $hospital->upazila_id = $hospitalData->upazila;
        $hospital->address = $hospitalData->address;
        $hospital->hospital_open_time = $hospitalData->open_hour;
        $hospital->hospital_closing_time = $hospitalData->closing_hour;

        $hospital->save();

        return $hospital;
    }

    public function getHospitalInFeniForHome()
    {
        $hospitals = Hospital::with([
            'division',
            'district',
            'upazila',
        ])->where('district_id', '=', 20)
            ->limit(15)
            ->get();
        return $hospitals;
    }

    public function getAllHospitals()
    {
        return Hospital::with([
            'division',
            'district',
            'upazila',
        ])->simplePaginate(3);
    }

    public function getSingleHospitalWithDoctor($hospital_id)
    {
        return Hospital::with([
            'doctors.qualifications.degree',
            'doctors.qualifications.institute',
            'doctors.expertises',
            'division',
            'district',
            'upazila',
        ])->find($hospital_id);
    }

    public function getAllHospitalsBelongsToDoctor($doctor_id)
    {
        return DB::table('doctors_in_hospitals')
            ->join('hospitals', 'doctors_in_hospitals.hospital_id', '=', 'hospitals.id')
            ->where('doctor_id', $doctor_id)
            ->get();
    }

    public function createbyAdmin($hospitalData)
    {
        $hospitalModel = new Hospital;
        $hospitalModel->hospital_name = $hospitalData->hospital_name;
        $hospitalModel->username = $hospitalData->username;
        $hospitalModel->email = $hospitalData->email;
        $hospitalModel->password = bcrypt($hospitalData->password);
        $hospitalModel->mobile_phone = $hospitalData->mobile_phone;
        $hospitalModel->telephone = $hospitalData->telephone;
        $hospitalModel->optional_title = $hospitalData->optional_title;

        $hospitalModel->division_id = $hospitalData->division;
        $hospitalModel->district_id = $hospitalData->district;
        $hospitalModel->upazila_id = $hospitalData->upazila;

        $hospitalModel->address = $hospitalData->address;
        $hospitalModel->hospital_open_time = Carbon::parse($hospitalData->open_hours);
        $hospitalModel->hospital_closing_time = Carbon::parse($hospitalData->closing_hours);

        $hospitalModel->is_activated = $hospitalData->is_activated == true ? 1 : 0;
        $hospitalModel->activated_at = Carbon::now();
        $hospitalModel->save();

        return $hospitalModel;
    }

    public function updateByAdmin($hospitalData, $hospitalModel)
    {
        $hospitalModel->hospital_name = $hospitalData->hospital_name;
        $hospitalModel->username = $hospitalData->username;
        $hospitalModel->email = $hospitalData->email;
        $hospitalModel->mobile_phone = $hospitalData->mobile_phone;
        $hospitalModel->telephone = $hospitalData->telephone;
        $hospitalModel->optional_title = $hospitalData->optional_title;

        $hospitalModel->password = $hospitalData->password == true ? bcrypt($hospitalData->password) : $hospitalModel->password;

        $hospitalModel->division_id = $hospitalData->division;
        $hospitalModel->district_id = $hospitalData->district;
        $hospitalModel->upazila_id = $hospitalData->upazila;

        $hospitalModel->address = $hospitalData->address;
        $hospitalModel->hospital_open_time = Carbon::parse($hospitalData->open_hours);
        $hospitalModel->hospital_closing_time = Carbon::parse($hospitalData->closing_hours);

        $hospitalModel->is_activated = $hospitalData->is_activated == true ? 1 : 0;
        $hospitalModel->activated_at = Carbon::now();

        $hospitalModel->save();

        return $hospitalModel;
    }

    public function allHospitalForAdmin($per_page)
    {
        return Hospital::latest()->paginate($per_page);

    }

}
