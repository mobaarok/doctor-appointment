<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function redirect($route)
    {
        return redirect()->route($route);
    }

    protected function responseJson($message)
    {
        return response()->json([
            'fail' => true,
            'message' => $message,
        ]);
    }

    protected function notifySuccess($message)
    {
        session()->flash('messageType', 'success');
        session()->flash('message', $message);
    }

    protected function notifyError($message)
    {
        session()->flash('messageType', 'danger');
        session()->flash('message', $message);
    }

    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return view('errors404', $data, $errorCode);
    }
}
