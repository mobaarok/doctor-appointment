@extends('user/layout/master')

@section('content')

<div class="container">
    <!-- main row  -->
    <div class="row">
        <div class="col-md-8">
            <!-- title Crad Start -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Your appoinment suceess</h5>
                    @if (session('message'))
                    <div class="alert alert-{{ session('messageType') }}" role="alert">
                        {{ session("message") }}
                    </div>
                    @endif

                    <p>Please remember your appoinment no bellow</p>
                </div>
            </div>
            <!-- title Card End -->

            <!-- Single Crad Start -->
            <div class=" mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">appoinment Details.</h5>
                        <h4>Hospital: {{ $book_doctor->hospital->hospital_name}}</h4>
                        <h3>Doctor: {{$book_doctor->doctor->doctor_name}}</h3>
                        <p>appoinment date: {{$book_doctor->booking_date->rawFormat('D, j M, Y')}}  </p>
                        <p>time: {{$book_doctor->booking_hours->isoFormat('h:m A')}} </p>
                        <p>serial no: {{$book_doctor->serial_number}}   </p>
                        <p>appoinment slip code: {{$book_doctor->booking_id}} </p>
                        <button class="btn btn-success">Download slip</button>
                        <a href="{{ route('user.downloadPdf') }}"> Download slif</a>


                    </div>
                </div>
            </div>
            <!-- Single Card End -->



        </div>
        <div class="col-md-4">
            <!-- sidebar Crad Start -->

            <div class="card mt-3" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">sidebar menu.</h5>
                    <h5 class="card-title">sidebar menu.</h5>
                    <h5 class="card-title">sidebar menu.</h5>
                    <h5 class="card-title">sidebar menu.</h5>
                </div>
            </div>
            <!-- sidebar Card End -->
        </div>
    </div>
</div>
@endsection
