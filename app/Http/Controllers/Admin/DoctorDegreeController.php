<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\DoctorEducationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorDegreeController extends BaseController
{
    public function index()
    {
        $degrees = DB::table('doctor_degrees')->paginate(10);
        return view('admin.doctor_degree.manage', ["degrees" => $degrees]);
    }

    public function store(Request $request, DoctorEducationRepository $doctorEducationRepository)
    {
        $validator = Validator::make($request->all(), [
            'degree_st_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $doctorEducationRepository->createDegree($request);
        $this->notifySuccess("Added new Entry");
        return redirect()->back();
    }

    public function edit($id)
    {
        $degree = DB::table('doctor_degrees')->find($id);
        return view('admin.doctor_degree.edit', ["degree" => $degree]);
    }

    public function update($id, Request $request, DoctorEducationRepository $doctorEducationRepository)
    {
        $validator = Validator::make($request->all(), [
            'degree_st_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $doctorEducationRepository->updateDegree($request, $id);
        $this->notifySuccess("Update Successfully");
        return $this->redirect('admin.doctor-degree.index');
    }

}
