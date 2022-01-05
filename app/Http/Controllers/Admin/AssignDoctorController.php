<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorAssignRequest;
use App\Model\Doctor;
use App\Model\Hospital;
use App\Repositories\AssignDoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AssignDoctorController extends BaseController
{
     public function assignDoctorModal($id)
    {
        $barTime = [
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
        ];
        $hospital = Hospital::find($id);
    
        $doctors = Doctor::get();
        return view('admin.hospital.assign_modal', [
            'doctors' => $doctors,
            'hospital' => $hospital,
            'barTime' => $barTime,
        ]);
    }

    public function assignDoctor(
        AssignDoctorRepository $assignDoctorRepository,
        DoctorAssignRequest $request
    ) {
        // thth 
        $hospital_id = $request->hospital_id;
        $doctor_id = $request->doctor_id;
        $oldDoctorId = DB::table('doctors_in_hospitals')
            ->where('hospital_id', '=', $hospital_id)
            ->pluck('doctor_id');
            $isDoctorAlreadyExists = Arr::first(
            $oldDoctorId,
            function ($item, $key) use ($doctor_id) {
                return $item == $doctor_id ? true : false;
            }
        );

        // $oldDoc = DB::table('doctors_in_hospitals')
        //     ->where('hospital_id', $hospital_id)->get()->toArray();
        // $isDocExists = collect($oldDoc)->where('doctor_id', $doctor_id)->first();
        // return $isDocExists;
        // die();

        if ($isDoctorAlreadyExists) {
            $this->notifyError('Doctor already exist in this hospital!');
            return redirect()->back();
        } else {
            $assignDoctorRepository->create($request);
            $this->notifySuccess('Doctor Assign Successful!');
            return redirect()->back();
        }
    }

}
