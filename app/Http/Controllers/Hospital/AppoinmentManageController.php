<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Appoinment\Appoinment;

class AppoinmentManageController extends Controller
{
    public function index() {
        $setToday = Carbon::today(+6)->format('Y-m-d');
        $hospital_id = Auth::guard('hospital')->user()->id;
        $doctorsInHospital = DB::table('doctors_in_hospitals')
            ->join('doctors', 'doctors_in_hospitals.doctor_id', '=', 'doctors.id')
            ->where('hospital_id', $hospital_id)->get();
        return view('hospital.appoinment.manage', ['doctors' => $doctorsInHospital, 'setToday' => $setToday, 'hospital_id' => $hospital_id]);
    }

    public function getAppoinmentList(Request $request)
    {

        $doctor_id = $request->doctor_id;
        $appo_date = $request->appoDate == false ? Carbon::today() : $request->appoDate;
        $hospital_id = Auth::guard('hospital')->user()->id;
        $book_list = DB::table('booking_doctor')->where([
            ['hospital_id', $hospital_id],
            ['doctor_id', $doctor_id],
        ])
            ->whereDate('booking_date', $appo_date)
            ->get();
        return response()->json([
            "status_code" => 200,
            "message" => "success",
            "book_list" => $book_list,
        ]);
    }

    public function appoinmentCompleteAction(Request $request)
    {
        $id = $request->booking_id;

        $data = DB::table('booking_doctor')
            ->where("id", $id)
            ->update(['is_complete' => 1]);

        return $data;
    }

    public function appoDate($barname)
    {
        $barTime = [];

        $startDate = date('d-m-Y');

        $endDate = date('d-m-Y', strtotime('+30 days'));

        // change string to date time object
        $startDate = new DateTime($startDate);

        $endDate = new DateTime($endDate);

        $barnameLen = count($barname);

        while ($startDate <= $endDate) {
            //  timestamp value of start date
            $timestamp = strtotime($startDate->format('d-m-Y'));
            // find day name
            $bar = date('l', $timestamp);
            for ($j = 0; $j < $barnameLen; $j++) {
                if ($barname[$j] == $bar) {
                    $res = $bar . ' ' . $startDate->format('d-F-Y');
                    array_push($barTime, $res);
                }
            }
            $startDate->modify('+1 day');
        }
        return $barTime;
    }

    public function getDoctorSitDate(Request $request)
    {
        // $doctor = DB::table('doctors_in_hospitals')->where('doctor_id', $request->doctor_id)->first();
        // $barname =  unserialize($doctor->bartime);
        // $sit_date = $this->appoDate($barname);
      //  dd($request->all());
        $barname = [];
        $hospital_id =  auth('hospital')->user()->id;

        $barnameArray = DB::table('doctor_sit_datetimes')
            ->where([
                ['doctor_id', $request->doctor_id],
                ['hospital_id', $hospital_id],
            ])
            ->get();
        foreach ($barnameArray as $item) {
            array_push($barname, $item->bar);
        }

        $sit_date = $this->appoDate($barname);
// alll before item cancle hobe.

        $hospital_id =  auth('hospital')->user()->id;
        $appoinment = new Appoinment();
        $sit_date = $appoinment->getDoctorSitDates($request->doctor_id, $hospital_id);

        return response()->json($sit_date);
    }



    public function addLocalSerial(Request $request)
    {
        $appoinment = DB::table('booking_doctor')->insert([
            'hospital_id' => auth('hospital')->user()->id,
            'doctor_id' => $request->doctor_id,
            'patient_name' => $request->paitent_name,
            'patient_age' => $request->patient_age,
            'booking_date' => Carbon::parse($request->appoinment_date),
            'patient_phone' => $request->mobile,
            'serial_type' => $request->serial_type,
            'created_at' => Carbon::now(),
            'user_id'      => $request->user_id,
            'booking_id'      => 4242,
            'serial_number'    =>  33,
        ]);
        return $appoinment;
    }

}
