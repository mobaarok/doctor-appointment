<?php
    // input start and end date
    $startDate = "01-10-2020";
    $endDate = "30-10-2020";

    $resultDays = array('Monday' => 0,
    'Tuesday' => 0,
    'Wednesday' => 0,
    'Thursday' => 0,
    'Friday' => 0,
    'Saturday' => 0,
    'Sunday' => 0);

    // change string to date time object
    $startDate = new DateTime($startDate);
    $endDate = new DateTime($endDate);

    // iterate over start to end date
    while($startDate <= $endDate ){
        // find the timestamp value of start date
        $timestamp = strtotime($startDate->format('d-m-Y'));

        // find out the day for timestamp and increase particular day
        $weekDay = date('l', $timestamp);
    // $resultDays[$weekDay] = $resultDays[$weekDay] + 1;
    // if($weekDay == 'Monday' || $weekDay == "Friday") {
    //     echo  $weekDay . " and day is " . $startDate->format('d-m-Y') . "\n";
    // }
        // increase startDate by 1
        $startDate->modify('+1 day');
    }

// print the result


  function appoDate()
    {
    $barTime = [];
        $startDate = "01-10-2020";
        $endDate = "30-10-2020";
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        while ($startDate <= $endDate) {
        $timestamp = strtotime($startDate->format('d-m-Y'));
            $weekDay = date('l', $timestamp);
            if ($weekDay == 'Monday' || $weekDay == "Friday") {
                $item =  $weekDay . " " . $startDate->format('d-m-Y');
                array_push($barTime, $item);
            }
            // increase startDate by 1
            $startDate->modify('+1 day');
            // echo date('d-m-Y', time()); this give me today's date
        }
        return $barTime;
    }
 $tp = appoDate();

$ar = ['apple', 'orange', 'pear', 'grape'];
 implode(', ', $ar);
$myArray = array('arr1', 'mongo');
$seralizedArray = unserialize('a:3:{i:0;s:8:"Saturday";i:1;s:6:"Sunday";i:2;s:6:"Friday";}');
print_r($seralizedArray);


//new work

    public function appoDate($barname)
    {
        $arrObj = [];
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

                    //this work for maknig an object //work date- march-22-2021
                    $date = $startDate->format('d-F-Y');
                    $newArr = array("day" => $bar, "date" => $date);
                    $newObj = (object) $newArr;
                    array_push($arrObj, $newObj);
              //      ["day" => "monday", "date" => '22 - March - 2021']
                    // exit();
                    array_push($barTime, $res);
                }
            }
            $startDate->modify('+1 day');
        }
        return $arrObj;
    }
