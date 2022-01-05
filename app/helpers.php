<?php

if (!function_exists('isBarExist')) {
    function isBarExist()
    {
       return $barTime = [
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
        ];
    }
}

if (!function_exists('notify_success')) {
    function notify_success($message)
    {
        session()->flash('type', 'success');
        session()->flash('message', $message);
    }
}

if (!function_exists('notify_error')) {
    function notify_error($message)
    {
        session()->flash('type', 'danger');
        session()->flash('message', $message);
    }
}
