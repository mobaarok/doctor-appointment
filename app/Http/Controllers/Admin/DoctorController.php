<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\DoctorRepository;
use App\Http\Requests\StoreDoctorRequest;
use App\Model\DoctorDegree;
use App\Model\DoctorEducation;
use App\Model\DoctorInstitute;
use App\Model\Expertise;

class DoctorController extends BaseController
{
    protected $doctorRepository;

    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    public function index()
    {
        $doctors =  $this->doctorRepository->getAllDoctors();
        return view('admin.doctor.manage', ['doctors' => $doctors]);
    }

    public function create()
    {
        $institute = DoctorInstitute::get();
        $degree = DoctorDegree::get();
        $expertise = Expertise::get();
        return view('admin.doctor.create', [
            'institutes' => $institute, 
            'degrees' => $degree,
             'expertises' => $expertise
             ]);
    }

    public function store(StoreDoctorRequest $request)
    {

        $doctor = $this->doctorRepository->create($request);
        $this->notifySuccess($doctor->doctor_name . ' ' . 'Doctor Created Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}



