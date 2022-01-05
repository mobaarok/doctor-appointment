<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\HospitalRepository;

class UserHospitalController extends Controller
{
    protected $hospitalRepository;

    public function __construct(HospitalRepository $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    public function getAllHospitals()
    {
        $hospitals = $this->hospitalRepository->getAllHospitals();
        return view('user.all_hospitals', ['hospitals' => $hospitals]);
    }

    public function singleHospital($id)
    {
        $hospital = $this->hospitalRepository->getSingleHospitalWithDoctor($id);
        return view('user.single_hospital', [
            'hospital' => $hospital,
        ]);
    }
}