<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\DoctorEducationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorInstituteController extends BaseController
{
    public function index()
    {
        $institutes = DB::table('doctor_institutes')->paginate(10);
        return view('admin.doctor_institute.manage', ["institutes" => $institutes]);
    }

    public function store(Request $request, DoctorEducationRepository $doctorEducationRepository)
    {
        $validator = Validator::make($request->all(), [
            'institute_st_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $doctorEducationRepository->createInstitute($request);
        $this->notifySuccess("Added new Entry");
        return redirect()->back();
    }

    public function edit($id)
    {
        $institute = DB::table('doctor_institutes')->find($id);
        return view('admin.doctor_institute.edit', ["institute" => $institute]);
    }

    public function update($id, Request $request, DoctorEducationRepository $doctorEducationRepository)
    {
        $validator = Validator::make($request->all(), [
            'institute_st_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $doctorEducationRepository->updateInstitute($request, $id);
        $this->notifySuccess("Update Successfully");
        return redirect(route('admin.doctor-institute.index'));
    }

}
