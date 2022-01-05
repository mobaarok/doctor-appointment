<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\ApiAppoinmentRequest;
use App\Repositories\AppoinmentRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiAppoinmentController extends Controller
{
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

    public function appoinment(Request $request)
    {
        $barname = [];
        $barnameArray = DB::table('doctor_sit_datetimes')
            ->where([
                ['doctor_id', $request->doctor_id],
                ['hospital_id', $request->hospital_id],
            ])
            ->get();
        foreach ($barnameArray as $item) {
            array_push($barname, $item->bar);
        }

        $sit_date = $this->appoDate($barname);
        $requestData = $request->all();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Appoinment proccss',
            'data' => ['requestData' => $requestData, 'sit_date' => $sit_date],
        ]);

    }


    public function appoinmentAction(ApiAppoinmentRequest $request, AppoinmentRepository $appoinmentRepository)
    {
        $lastInsertId = $appoinmentRepository->create($request);
        $data = DB::table('booking_doctor')->where('id', $lastInsertId)->first();
        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'appoinment store successfully',
            'data' => ['appoinment_info' => $data],
        ]);
    }
}
