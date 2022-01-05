@extends('hospital/layout/master')
@section('content')

<div class="main-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <h5>Your accout email is not Verified, Please Verified your email</h5>
                <a class="btn btn-warning" href="{{ route('hospital.email.verification')}}">Send Verified Link</a>

                <a class="btn btn-warning" href="{{ route('hospital.change.password')}}">Change Password</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--offset-md-1-->
                <div class="card" style="min-height: 390px;">
                    <div class="card-header font-weight-bold">
                        <h2>{{$hospital->hospital_name}}</h2>
                        <div class="card-header-right">
                            <a class="btn btn-info" href="{{route('hospital.editProfile')}}">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <h4>Email: {{$hospital->email}}</h4>
                        <h4>Mobile: {{$hospital->mobile_phone}}</h4>
                        <h4>Telephone: {{$hospital->telephone}}</h4>
                        <h4>Address:
                            {{$hospital->division->division_name ?? ''}} ,
                            {{$hospital->district->district_name ?? ''}} ,
                            {{$hospital->upazila->upazila_name ?? ''}},
                            {{$hospital->address}}</h4>
                        <h5>Open hour: {{$hospital->hospital_open_time->isoFormat('hh:mm A')}}</h5>
                        <h5>Close Time: {{$hospital->hospital_closing_time->isoFormat('hh:mm A')}} </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection