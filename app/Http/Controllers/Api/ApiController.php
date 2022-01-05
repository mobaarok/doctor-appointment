<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function getAllDoctors()
    {
        $doctors = Doctor::get();
        return response()->json([
            'success' => true,
            'code'  => 200,
            'message' => 'All doctor list',
            'data' => ['doctors' =>  $doctors],
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $hospitals = DB::table('hospitals')
        ->where("hospital_name",  "like", "%{$search}%")
        ->get();
        return response()->json([
            'success' => true,
            'code'  => 200,
            'message' => 'Search Resault',
            'data' => [  "search" => $search, "hospitals" => $hospitals],
        ]);
    }

    public function blogAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(["err" => $validator->errors()]);
        }

    }
}
