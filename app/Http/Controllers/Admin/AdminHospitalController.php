<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\HospitalEditRequest;
use App\Http\Requests\Admin\HospitalStoreRequest;
use App\Model\Hospital;
use App\Repositories\HospitalRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;

class AdminHospitalController extends BaseController
{
    protected $hospitalRepository;
    protected $locationRepository;

    public function __construct(
        HospitalRepository $hospitalRepository,
        LocationRepository $locationRepository
    ) {
        $this->hospitalRepository = $hospitalRepository;
        $this->locationRepository = $locationRepository;
    }

    public function index(Request $request)
    {
        $page = $request->input("page", 1);
        $per_page = 10;
        $hospitals = $this->hospitalRepository->allHospitalForAdmin($per_page);
        $divisions = $this->locationRepository->getAllDivision();
        return view('admin.hospital.manage', [
            'hospitals' => $hospitals,
            'divisions' => $divisions,
            'page' => $page,
            'per_page' => $per_page,
        ]);
    }

    public function create()
    {
        $divisions = $this->locationRepository->getAllDivision();
        return view('admin.hospital.create', ['divisions' => $divisions]);
    }

    public function store(HospitalStoreRequest $request)
    {
        $this->hospitalRepository->createByAdmin($request);
        $this->notifySuccess('Hospital Created Successfully!');
        return redirect()->back();
        $this->notifyError('Something Went Wrong!');
        return redirect()->back();
    }

    public function show($id)
    {
        $hospitalWithDoctors = $this->hospitalRepository->getSingleHospitalWithDoctor($id);
        return view('admin.hospital.single_hospital', [
            'hospitalWithDoctors' => $hospitalWithDoctors,
        ]);
    }

    public function edit($id)
    {
        $hospital = Hospital::with([
            'division',
            'district',
            'upazila',
        ])->find($id);

        $divisions = $this->locationRepository->getAllDivision();
        return view('admin.hospital.edit', [
            'hospital' => $hospital,
            'divisions' => $divisions,
        ]);
    }

    public function update(HospitalEditRequest $request, $id)
    {
        $hospitalModel = Hospital::find($id);
        $hospital = $this->hospitalRepository->updateByAdmin($request, $hospitalModel);
        $this->notifySuccess($hospital->hospital_name . ' ' . 'Updated Successfully!');
        return $this->redirect('admin.hospital.index');
    }

}
