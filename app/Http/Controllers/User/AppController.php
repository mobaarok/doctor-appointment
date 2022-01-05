<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\DoctorRepository;
use App\Repositories\HospitalRepository;
use App\Repositories\LocationRepository;

class AppController extends Controller
{
    protected $hospitalRepository;
    protected $doctorRepository;
    protected $locationRepository;

    public function __construct(
        HospitalRepository $hospital, 
        DoctorRepository $doctor, 
        LocationRepository $location)
    {
        $this->hospitalRepository = $hospital;
        $this->doctorRepository = $doctor;
        $this->locationRepository = $location;
    }

    public function renderHome()
    {
        $hospitals = $this->hospitalRepository->getHospitalInFeniForHome();
        // dd($hospitals);
        $doctors = $this->doctorRepository->getDoctorInFeniForHome();
        // $divisions = $this->locationRepository->getAllDivision();
        $upazilas = $this->locationRepository->getUpazilaByDistrictId(20); //feni
        // return $doctors;
        return view('user.app', [
            'hospitals' => $hospitals,
            'doctors' => $doctors,
            // 'divisions' => $divisions,
            'cities'  => $upazilas,
        ]);
    }
}