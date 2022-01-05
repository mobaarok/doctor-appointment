@extends('hospital/layout/master')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Doctor Information</h3>
            <p class="text-subtitle text-muted">For user to check they list</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Doctors</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- msg section -->
@if (session('message'))
<div class="row">
    <div class="col-md-6 offset-md-6">
        <div class="alert alert-{{
                session('messageType')
            }} alert-dismissible fade show" role="alert">
            <strong class="text-dark">{{ session("message") }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif


<!-- Basic Tables start -->
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon purple">
                            <dt style="font-size: 35px;" class="the-icon text-white"><span class="fa-fw select-all fas">   </span></dt>
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">
                                Dr. {{ $doctor->doctor_name }}
                            </h5>

                            <h6 class="text-muted mb-0">Consultant</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">

            <div class="card">
                <div class="card-header">
                    <h4>Total Count</h4>
                </div>

            </div>

        </div>

    </div>
</section>
<!-- Basic Tables end -->

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Expertise</h4>
                    </div>
                    <div class="card-body">
                        @foreach($doctor->expertises as $expertise)
                            <h5 class="ms-5 mb-3"> {{$expertise->expertise_name}} </h5>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">

                <div class="card">
                    <div class="card-header">
                        <h4>Educations</h4>
                    </div>
                    <div class="card-body">

                        @if($doctor->qualifications->isNotEmpty())
                        @foreach($doctor->qualifications as $qua)
                        <div class="ms-5 mb-3">
                            <h5 class="mb-1"> {{$qua->degree->degree_short_name}} </h5>
                            <h6 class="text-muted mb-0">@  {{$qua->institute->institute_short_name}} </h6>
                        </div>
                        @endforeach
                        @else
                        <h5 class="text-muted">Education details not fonud!</h5>
                        @endif


                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- Basic Tables end -->

<!-- Basic Tables start -->
<section class="section">
<div class="row" id="basic-table">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start">Visit day/hour</h4>
                <a class="btn btn-dark  float-end" href="{{ route('hospital.visitDayTime', $doctor->id) }}">Add Visit day/hour</a>
                <!-- <div class="d-flex justify-content-between ">
                    <h4 class="card-title">Doctors List</h4>
                    <a class="btn btn-info " href="">Add Doctor</a>
                </div> -->
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Shift</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctor->visitHour as $visit)
                                <tr>
                                    <td class="text-bold-500 fw-bold">
                                            {{$visit->bar}}
                                    </td>
                                    <td>
                                        @if($visit->shift_type == "m")
                                       <span class="text-primary">  {{$visit->start_time->format('h:i A')}} </span>
                                        <span> to </span>
                                        <span> {{$visit->end_time->format('h:i A')}} </span>


                                        @elseif($visit->shift_type == "e")
                                     <span class="text-primary">   {{$visit->evening_start_time->format('h:i A')}} </span>
                                        <span> to </span>
                                        <span>{{$visit->evening_end_time->format('h:i A')}} </span>



                                        @elseif($visit->shift_type == "d")
                                        <span class="text-primary">{{$visit->day_start_time->format('h:i A')}}</span>
                                        <span> to </span>
                                        <span>{{$visit->day_end_time->format('h:i A')}}</span>


                                        @elseif($visit->shift_type == "b")
                                        <span class="text-primary">{{$visit->start_time->format('h:i A')}} </span>
                                        <span> to </span>
                                        <span>{{$visit->end_time->format('h:i A')}} </span>

                                        <br>

                                        <span class="text-primary"> {{$visit->evening_start_time->format('h:i A')}}</span>
                                        <span> to </span>
                                        <span>{{$visit->evening_end_time->format('h:i A')}}</span>

                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">   {{$visit->shift_type}} </span>
                                    </td>
                                    <td class="text-bold-500">
                                        <a class="btn btn-info" href="{{ route('hospital.editVisitDayTime', [
                                        'hospital_id' => $visit->hospital_id,
                                        'doctor_id' => $visit->doctor_id,
                                        'bartime' => $visit->bar,
                                        'doctor_name' => $doctor->doctor_name
                                        ]) }}">Edit</a>
                                        <a class="btn btn-danger" href="">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
<!-- Basic Tables end -->

<!-- Basic Tables start -->
<section class="section">
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start">Doctor watch time</h4>
                <a class="btn btn-dark  float-end" href="{{ route('hospital.doctorWatchTime', ['doctor_id' => $doctor->id]) }}">Change</a>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <h5 class="font-bold">
                        {{$watch_min->doctor_watch_time ?? "5"}} Minute
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start">Daily paitent recieve</h4>
                <a class="btn btn-dark  float-end" href="{{ route('hospital.dailyPatientNumber', ['doctor_id' => $doctor->id]) }}">Change</a>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <h5 class="font-bold">
                        {{$patient_number->patient_number}} Person
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Basic Tables end -->




@endsection
