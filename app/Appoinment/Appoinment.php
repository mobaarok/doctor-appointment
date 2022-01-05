<?php

namespace App\Appoinment;

use DateTime;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\DB;

class Appoinment
{
    //call from controller
    public  function getDoctorSitDates($doctor_id, $hospital_id)
    {
        $dayNameArray = $this->getDayNameArray($doctor_id, $hospital_id);
        $sitDate = $this->appoinmentDateListMaker($dayNameArray);
        return $sitDate;
    }

    private function getDayNameArray($doctor_id, $hospital_id)
    {
        $dayNamesCollection = $this->getDoctorSitDayNamesCollection($doctor_id, $hospital_id);
        $dayName = array();
        foreach ($dayNamesCollection as $item) {
            array_push($dayName, $item->bar);
        }
        return $dayName;
    }

    private function getDoctorSitDayNamesCollection($doctor_id, $hospital_id)
    {
        $dayNames =   DB::table('doctor_sit_datetimes')
            ->where([
                ['doctor_id', $doctor_id],
                ['hospital_id', $hospital_id],
            ])
            ->get();
        return $dayNames;
        /*
  $dummy_daynames_collection = [
    {'id'=> 1, 'bar' => 'saturday'},
     {'id'=> 1, 'bar' => 'saturday'},
     {'id'=> 1, 'bar' => 'saturday'}
    ];
  */
    }

    public  function appoinmentDateListMaker($dayNameArray)
    {
        //note that i use the perametar name as '$dayName' or '$barname'
        $arrObj = []; //return an object list of a array
        $barTime = []; //return a array
        $startDate = date('d-m-Y'); //"29-04-2021"
        $endDate = date('d-m-Y', strtotime('+30 days'));
        // change string to date time object
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        $barnameLen = count($dayNameArray);


        while ($startDate <= $endDate) {
            //  timestamp value of start date
            $timestamp = strtotime($startDate->format('d-m-Y'));

            // find day name
            $bar = date('l', $timestamp);

            for ($j = 0; $j < $barnameLen; $j++) {
                if ($dayNameArray[$j] == $bar) {
                    $res = $bar . ' ' . $startDate->format('d-F-Y');

                    //this work for maknig an object //work date- march-22-2021
                    $date = $startDate->format('d-F-Y');
                    $newArr = array("day" => $bar, "date" => $date);
                    $newObj = (object) $newArr; //convert array to object
                    array_push($arrObj, $newObj);
                    // new work end here

                    array_push($barTime, $res);
                }
            }
            $startDate->modify('+1 day');
        }
        return $arrObj; // $barTime // can be return an array "$barTime" or object "$arrObj"

    }
}
