@extends('user/layout/master')
@section('content')
@section('css')
<style>

</style>
@endsection
<div>
    <div class="container">

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h2 class="card-title"> Dr. {{$doctor->doctor_name}} </h2>
                <h6 class="text-warning">{{$doctor->expertise}} spacialist</h6>
                <div>
                    @if($ref_hospital_id)
                    <a class="btn btn-info" href="{{ route('user.appoinment', [
                        'doctor' => $doctor->doctor_name,
                        'doctor_id' => $doctor->id,
                        'hospital' => $ref_hospital,
                        'hospital_id' => $ref_hospital_id,
                        ]) }}">
                        Take Appoinment in {{$ref_hospital}}
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <h2 class="mt-4"> Dr. {{$doctor->doctor_name}} also abailable in... </h2>

        <div class="row">
            @foreach($hospitals as $hospital)
            <div class="col-md-4">
                <div style="min-height: 13rem;" class="card border-0 shadow-sm my-2" width="23rem">
                    <div class="card-body">
                        <a href="{{ route('user.singleHospital',  $hospital->id ) }}">
                            <h5 class="card-title">{{$hospital->hospital_name}}</h5>
                        </a>
                        <address>{{$hospital->address}}</address>
                        <div>
                            <a class="btn btn-info" href="{{ route('user.appoinment', [
                                                                                            'doctor' => $doctor->doctor_name,
                                                                                            'doctor_id' => $doctor->id,
                                                                                            'hospital' => $hospital->hospital_name,
                                                                                            'hospital_id' => $hospital->id,
                                                                                            ]) }}"> Take Appoinment in
                                {{$hospital->hospital_name}} </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>


@section('script')


@endsection
@endsection