@extends('user/layout/master')
@section('content')
<div>


    <div class="container">
        <!-- title Crad Start -->
        <div class="card border-0 shadow-sm my-3">
            <div class="card-body">
                <h5 class="card-title"> {{ $hospital->hospital_name}}</h5>
                <Address>Address: {{$hospital->address}}
                    {{$hospital->upazila->upazila_name ??'' }}
                    {{$hospital->district->district_name ?? ''}}
                    {{ $hospital->division->division_name ?? ''}}
                </Address>
                <p>Mobile: {{$hospital->mobile_phone ?? 'none'}}</p>
                <p>Telephone: {{$hospital->telephone ?? 'none'}}</p>
                <p>Email: {{$hospital->email ?? 'none'}}</p>

                @if( $hospital->hospital_open_time)
                <p>Open Hours: {{ $hospital->hospital_open_time->isoFormat('hh:mm A') }} -
                    {{$hospital->hospital_closing_time->isoFormat('hh:mm A') }}</p>
                @endif
            </div>
        </div>
        <!-- title Card End -->
        <h4>Doctor</h4>
        <div class="row">
            <!-- Single Crad Start -->
            @foreach($hospital->doctors as $doctor)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm my-2" style="width: 23rem;">

                    <div class="card-body">
                        <a class="card-href"
                            href="{{ route('user.singleDoctor', [$doctor->id, 'hospital' => $hospital->hospital_name, 'hospital_id' => $hospital->id] ) }}">
                            <h5 class="card-title"> {{$doctor->doctor_name}} </h5>
                        </a>
                        <p class="card-text">
                            @foreach($doctor->expertises as $expertise)
                                <span>
                                    {{$expertise->expertise_name}}
                                </span>
                            @endforeach
                        </p>
                        @foreach($doctor->qualifications as $qua)
                        <span>{{$qua->degree->degree_short_name}} ( {{$qua->institute->institute_short_name}})</span>
                        @endforeach

                        <div>
                            <a href="{{ route('user.appoinment', [
                            'doctor' => $doctor->doctor_name,
                            'hospital' => $hospital->hospital_name,
                            'doctor_id' => $doctor->id,
                            'hospital_id' => $hospital->id,
                            ]) }}" class="btn btn-primary">
                                Appoinment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Single Card End -->
        </div>

    </div>






</div>

@endsection