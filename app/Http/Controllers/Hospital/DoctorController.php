<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\BaseController;
use App\Http\Requests\DoctorAssignRequest;
use App\Http\Requests\VisitDayTimeRequest;
use App\Model\Doctor;
use App\Model\Hospital;
use App\Repositories\AssignDoctorRepository;
use App\Repositories\VisitDayTimeRepo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\DoctorWatchTime;

class DoctorController extends BaseController
{
    public function doctorsInHospital(Request $request)
    {
        $page = $request->input("page", 1);
        $per_page = 10;
        $hospital_id = Auth::guard('hospital')->user()->id;

        $doc = Doctor::with([
            'expertises',
            'visitHour' => function ($query) use ($hospital_id) {
                $query->where('hospital_id', $hospital_id);
            },
        ])->whereHas('hospitals', function (Builder $query) use ($hospital_id) {
            $query->where('hospital_id', '=', $hospital_id);
        })->paginate($per_page);
        return view('hospital.doctor.doctors', [
            'doctors' => $doc,
            'page' => $page,
            'per_page' => $per_page,
        ]);
    }

    public function singleDoctor(Request $request)
    {
        $doctor_id = $request->id;
        $hospital_id = Auth::guard('hospital')->user()->id;
        $doctor = Doctor::with([
            'expertises',
            'qualifications.degree',
            'qualifications.institute',
            'visitHour' => function ($query) use ($hospital_id) {
                $query->where('hospital_id', $hospital_id);
            },
        ])->find($doctor_id);

        $watch_min = DB::table('doctor_watch_time')->where([
            ['doctor_id', '=', $doctor_id],
            ['hospital_id', '=', $hospital_id],
        ])->first();

        $patient_number = DB::table('daily_patient_numbers')->where([
            ['doctor_id', '=', $doctor_id],
            ['hospital_id', '=', $hospital_id],
        ])->first();

        return view('hospital.doctor.single_doctor', [
            'doctor' => $doctor,
            'watch_min' => $watch_min,
            'patient_number' => $patient_number
        ]);
    }

    public function addDoctor()
    {
        $hospital = Auth::guard('hospital')->user();
        $doctors = Doctor::get();
        return view('hospital.doctor.add_doctor', [
            'doctors' => $doctors,
            'hospital' => $hospital,
        ]);
    }

    public function addDoctorAction(
        AssignDoctorRepository $assignDoctorRepository,
        DoctorAssignRequest $request
    ) {
        $hospital_id = $request->hospital_id;
        $doctor_id = $request->doctor_id;
        $oldDoctorId = DB::table('doctors_in_hospitals')
            ->where('hospital_id', '=', $hospital_id)
            ->pluck('doctor_id');

        $isDoctorExists = Arr::first(
            $oldDoctorId,
            function ($item, $key) use ($doctor_id) {
                return $item == $doctor_id ? true : false;
            }
        );

        if ($isDoctorExists) {
            $this->notifyError('Doctor already exist in this hospital!');
            return redirect()->back();
        } else {
            $assignDoctorRepository->create($request);
            $this->notifySuccess('Doctor Assign Successful!');
            return redirect()->back();
        }
    }

    public function visitDayTime($doctor_id)
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
        $hospital = Auth::guard('hospital')->user();
        $doctor = Doctor::find($doctor_id);

        return view('hospital.doctor.add_visit_datetime', [
            'doctor' => $doctor,
            'hospital' => $hospital,
            'barTime' => $barTime,
        ]);
    }

    public function visitDayTimeAction(
        VisitDayTimeRequest $request,
        VisitDayTimeRepo $visitDayTimeRepo
    ) {
       $isExists =  DB::table('doctor_sit_datetimes')->where([
            ['hospital_id', $request->hospital_id],
            ['doctor_id', $request->doctor_id],
            ['bar', $request->bartime]
        ])->get();

        // dd($isExists->isEmpty());
        if($isExists->isEmpty()) {
            $visitDayTimeRepo->store($request);
        } else {
            $this->notifyError('Allready this day exist, please edit this!');
            return redirect()->back();

        }


         return redirect()->route('hospital.singleDoctor', $request->doctor_id);
    }

    public function editVisitDayTime(Request $request)
    {
        $bartime = $request->bartime;
        $doctor_name = $request->doctor_name;
        $doctor_id = $request->doctor_id;
        $hospital_id = $request->hospital_id;

        $bartime_object =  DB::table('doctor_sit_datetimes')->where([
            ['hospital_id', $hospital_id],
            ['doctor_id', $doctor_id],
            ['bar', $bartime]
        ])->first();
    //  dd($bartime_object) ;
        return view('hospital.doctor.edit_single_visit_day', [
            'bartime' => $bartime,
            'doctor_name' => $doctor_name,
            'doctor_id' => $doctor_id,
            'hospital_id' => $hospital_id,
            'bartime_object' => $bartime_object,
        ]);
    }

    public function editVisitDayTimeAction(
        VisitDayTimeRequest $request,
        VisitDayTimeRepo $visitDayTimeRepo
    )
    {
        // dd($request->all());
        return $visitDayTimeRepo->update($request);
    }

    public function doctorWatchTime(Request $request)
    {
        $hospital = Auth::guard('hospital')->user();
        $doctor = Doctor::find($request->doctor_id);
        return view('hospital.doctor.watch_time_set', ['hospital' => $hospital, 'doctor' => $doctor]);
    }

    public function doctorWatchTimeAction(Request $request)
    {
       $data =  $request->validate([
            'hospital_id' => 'required',
            'doctor_id'   => 'required',
            'watch_time' => 'required|integer',
       ]);
       DoctorWatchTime::insert([
        'doctor_id' => $request->doctor_id,
        'hospital_id' => $request->hospital_id,
        'doctor_watch_time' => $request->watch_time,
       ]);
       return redirect()->route('hospital.singleDoctor', $request->doctor_id);

    }


    public function dailyPatientNumber(Request $request)
    {
        $hospital = Auth::guard('hospital')->user();
        $doctor = Doctor::find($request->doctor_id);
        return view('hospital.doctor.daily_patient_number',  ['hospital' => $hospital, 'doctor' => $doctor]);
    }

    public function dailyPatientNumberAction(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required',
            'doctor_id'   => 'required',
            'patient_number' => 'required|integer',
       ]);
        DB::table('daily_patient_numbers')->insert([
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $request->hospital_id,
            'patient_number' => $request->patient_number
        ]);

       return redirect()->route('hospital.singleDoctor', $request->doctor_id);
    }




}







//  public function addDoctorAction(
//         AssignDoctorRepository $assignDoctorRepository,
//         DoctorAssignRequest $request
//     ) {

//         // return $request->all();
//         // die();
//         $hospital_id = $request->hospital_id;
//         $doctor_id = $request->doctor_id;
//         $oldDoctorId = DB::table('doctors_in_hospitals')
//             ->where('hospital_id', '=', $hospital_id)
//             ->pluck('doctor_id');

//         $isDoctorAlreadyExists = Arr::first($oldDoctorId, function ($item, $key) use ($doctor_id) {
//             return $item == $doctor_id ? true : false;
//         });

//         if ($isDoctorAlreadyExists) {
//             $this->notifyError('Doctor already exist in this hospital!');
//             return redirect()->back();
//         } else {
//             $assignDoctorRepository->create($request);
//             $this->notifySuccess('Doctor Assign Successful!');
//             return redirect()->back();
//         }
//     }

// public function addDoctor()
// {
//     $barTime = [
//         'saturday' => 'Saturday',
//         'sunday' => 'Sunday',
//         'monday' => 'Monday',
//         'tuesday' => 'Tuesday',
//         'wednesday' => 'Wednesday',
//         'thursday' => 'Thursday',
//         'friday' => 'Friday',
//     ];
//     $hospital = Auth::guard('hospital')->user();
//     $doctors = Doctor::get();
//     return view('hospital.doctor.add_doctor', [
//         'doctors' => $doctors,
//         'hospital' => $hospital,
//         'barTime' => $barTime,
//     ]);
// }
