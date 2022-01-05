<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHospitalRequest;
use App\Model\Division;
use App\Model\Hospital;
use App\Repositories\HospitalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function registerInfo() {
        return view('hospital.hospital_reg_info');
    }

    public function home()
    {
        return view('hospital.index');
    }

    public function profile()
    {

        $hospital_id = Auth::guard('hospital')->user()->id;
        $hospital = Hospital::with([
            'division',
            'district',
            'upazila',
        ])->find($hospital_id);
        return view('hospital.hospital_profile', [
            'hospital' => $hospital,
        ]);
    }

    public function editHospital()
    {
        $divisions = Division::get();

        $hospital_id = Auth::guard('hospital')->user()->id;
        $hospital = Hospital::with([
            'division',
            'district',
            'upazila',
        ])->find($hospital_id);



        return view('hospital.edit_profile', [
            'hospital' => $hospital,
            'divisions' => $divisions,
        ]);
    }

    public function updateHospital(UpdateHospitalRequest $request, HospitalRepository $hospitalRepository, $id)
    {
        dd($request->all());
        $hospitalRepository->update($request, $id);
        return redirect()->back();
    }

}
