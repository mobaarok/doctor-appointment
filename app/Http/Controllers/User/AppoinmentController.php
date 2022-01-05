<?php

namespace App\Http\Controllers\User;

use App\Appoinment\Appoinment;
use App\Http\Controllers\BaseController;
use App\Http\Requests\AppoinmentRequest;
use App\Model\BookDoctor;
use App\Repositories\AppoinmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

class AppoinmentController extends BaseController
{
    public function appoinment(Request $request)
    {

//         $dt = Carbon::now()->toTimeString();
// dd($dt);
        $appoinment = new Appoinment();
        $sit_date = $appoinment->getDoctorSitDates($request->doctor_id, $request->hospital_id);
        $requestData = $request->all();

        return view('user.appoinment.appoinment_page', [
            'requestData' => $requestData,
            'sit_date' => $sit_date,
        ]);
    }

    public function appoinmentAction(
        AppoinmentRequest $request,
        AppoinmentRepository $appoinmentRepository
    ) {

        $last_insert_id =  $appoinmentRepository->create($request);
        $this->notifySuccess('Your Appoinment Successful!');
        return redirect()->route('user.appoinment.success', $last_insert_id);
    }

    public function appoinmentSuccess($booking_id)
    {
        $book_doctor = BookDoctor::with(['hospital', 'doctor'])
            ->find($booking_id);
    //  return $book_doctor;
            return view(
            'user.appoinment.appoinment_success',
            ['book_doctor' => $book_doctor]
        );
    }

    public function downloadPdf()
    {

        $pdf = PDF::loadView('user.pdf.appoinment_slip');
        // return $pdf->download('disney.pdf');
        return $pdf->stream('disnay.pdf');
}

    public function getVisitTime(Request $request)
    {
        $visit_time = DB::table('doctor_sit_datetimes')->where([
            ["hospital_id", "=", $request->hospital_id],
            ["doctor_id", "=", $request->doctor_id],
            ["bar", "=", $request->day],
        ])->first();
        return response()->json([
            "success" => true,
            "code" => 200,
            "visit_time" => $visit_time,
        ]);
    }

    public function appoinmentSlotChecker(Request $request)
    {
       $daily_patient_number =  $this->getDailyPatinentNumber($request);

        $last_serial_number =  $this->generateSerialNumber($request);
        if ($last_serial_number) {
            $generateSerialNumber  = $last_serial_number->serial_number;
        } else {
            $generateSerialNumber = 1;
        }

        if  ($generateSerialNumber < $daily_patient_number->patient_number) {
                $result  = "সিরিয়াল নেওয়ার জন্য কনফার্ম বাটন ক্লিক করুন";
                $isBtnDisabled = false;
        } else {
            $result = "আপনার সিলেক্ট করা তারিখে কোন সিরিয়াল খালি নাই। অন্য তারিখ -এ চেষ্টা করুন।";
            $isBtnDisabled = true;
        }


        return response()->json([
            "success" => true,
            "code" => 200,
            "slot_check_result" => $result,
            "is_btn_disabled" => $isBtnDisabled
        ]);
    }
    private function getDailyPatinentNumber($requestData) {
        return  DB::table('daily_patient_numbers')->where([
              ['hospital_id', '=', $requestData->hospital_id],
              ['doctor_id', '=', $requestData->doctor_id],
          ])->first();
      }
    //   eee

    private function generateSerialNumber($requestData) {
        $lastBookingItem = DB::table('booking_doctor')->where([
            ['hospital_id', '=', $requestData->hospital_id],
            ['doctor_id', '=', $requestData->doctor_id],
            ['booking_date', '=', Carbon::parse($requestData->appoinment_date)]
        ])->latest()->first();

        return $lastBookingItem;
    }


}

//comment

//    public function appoDate($barname)
//     {
//         $arrObj = []; //return an object list of a array
//         $barTime = []; //return a array
//         $startDate = date('d-m-Y');
//         $endDate = date('d-m-Y', strtotime('+30 days'));
//         // change string to date time object
//         $startDate = new DateTime($startDate);
//         $endDate = new DateTime($endDate);
//         $barnameLen = count($barname);

//         while ($startDate <= $endDate) {
//             //  timestamp value of start date
//             $timestamp = strtotime($startDate->format('d-m-Y'));
//             // find day name
//             $bar = date('l', $timestamp);

//             for ($j = 0; $j < $barnameLen; $j++) {
//                 if ($barname[$j] == $bar) {
//                     $res = $bar . ' ' . $startDate->format('d-F-Y');

//                     //this work for maknig an object //work date- march-22-2021
//                     $date = $startDate->format('d-F-Y');
//                     $newArr = array("day" => $bar, "date" => $date);
//                     $newObj = (object) $newArr; //convert array to object
//                     array_push($arrObj, $newObj);
//                     // new work end here

//                     array_push($barTime, $res);
//                 }
//             }
//             $startDate->modify('+1 day');
//         }
//         return $arrObj; // $barTime // can be return an array "$barTime" or object "$arrObj"
//     }
