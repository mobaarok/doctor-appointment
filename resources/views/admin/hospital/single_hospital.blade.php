@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Hospitals Details</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.hospital.index') }}">Hospital</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Details
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 400px">
                    <div class="card-header">
                        <h3>Details of <span class="text-info"> {{$hospitalWithDoctors->hospital_name}} </span></h3>
                        <div class="card-header-right">

                        </div>
                    </div>
                    <div class="card-body">
                        <h5>Email: {{$hospitalWithDoctors->email}}</h4>
                            <p>Mobile: {{$hospitalWithDoctors->mobile_phone}}</p>
                            <p>Telephone: {{$hospitalWithDoctors->telephone}}</p>
                            <p>Username: {{$hospitalWithDoctors->username}}</p>
                            <address> Address:
                                <span> {{$hospitalWithDoctors->address ?? ''}} </span>
                                <span> {{$hospitalWithDoctors->upazila->upazila_name ?? ''}}, </span>
                                <span>{{$hospitalWithDoctors->district->district_name ?? ''}},</span>
                                <span>{{ $hospitalWithDoctors->division->division_name ?? '' }}</span>
                            </address>
                            <p>
                                Open time: {{$hospitalWithDoctors->hospital_open_time}} -
                                {{$hospitalWithDoctors->hospital_closing_time}}
                            </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Doctor's in {{$hospitalWithDoctors->hospital_name}}...</h1>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <!-- Single Crad Start -->
            @foreach($hospitalWithDoctors->doctors as $doctor)
            <div class="col-md-4 mt-5">
                <div class="card" style="width: 20rems;">
                    <div class="card-body">
                        <h5 class="card-title"> {{$doctor->doctor_name}} </h5>
                        <!-- <p class="card-text">{{$doctor->expertise}}</p> -->
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Single Card End -->
        </div>


@endsection
