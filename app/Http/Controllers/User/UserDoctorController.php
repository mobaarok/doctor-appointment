<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\DoctorRepository;
use App\Repositories\HospitalRepository;
use Illuminate\Http\Request;

class UserDoctorController extends Controller
{
    protected $hospitalRepository;
    protected $doctorRepository;

    public function __construct(
        HospitalRepository $hospitalRepository,
        DoctorRepository $doctorRepository
    ) {
        $this->hospitalRepository = $hospitalRepository;
        $this->doctorRepository = $doctorRepository;
    }

    public function singleDoctor(Request $request, $id)
    {
        $ref_hospital = $request->hospital;
        $ref_hospital_id = $request->hospital_id;
        $doctor = $this->doctorRepository->getDoctorById($id);
        $hospitals = $this->hospitalRepository->getAllHospitalsBelongsToDoctor($id);

        return view('user.single_doctor', [
            'ref_hospital' => $ref_hospital,
            'ref_hospital_id' => $ref_hospital_id,
            'doctor' => $doctor,
            'hospitals' => $hospitals,
        ]);
    }
}