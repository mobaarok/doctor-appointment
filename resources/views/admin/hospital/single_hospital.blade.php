@extends('admin/layout/master') @section('content')

<div class="main-content">
    <div class="container-fluid">

        {{-- Page Header && Breadcrumb Start --}}
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-align-right bg-secondary"></i>
                        <div class="d-inline">
                            <h5>Hospital Details</h5>
                            <span>details of a hospital.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.hospital.index') }}">Hospital</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- Page Header && Breadcrumb end --}}

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




    </div>
</div>


@endsection