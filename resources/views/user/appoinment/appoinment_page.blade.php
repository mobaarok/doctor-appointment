@extends('user/layout/master') @section('content')

<div class="container">
    <!-- main row  -->
    <div class="row">
        <div class="col-md-8">
            <!-- title Crad Start -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">
                        Take Appoinmnet to {{$requestData['hospital']}}


                    </h5>
                </div>
            </div>
            <!-- title Card End -->

            <!-- Single Crad Start -->
            <div class="mt-5">
                <div class="card">
                    <div class="card-body">
                        <h3>Hospital: {{ $requestData["hospital"] }}</h3>
                        <h5 class="card-title">
                            Doctor Name: {{ $requestData["doctor"] }}
                        </h5>
                        <p class="card-text">Psychologiest</p>
                        <form action="{{ route('user.appoinmentAction') }}" method="POST">
                            @csrf
                            <!-- data -->
                            @php $regUser = auth()->user() ?? ''; @endphp
                            <input type="text" name="user_id" value="{{ $regUser->id ?? ''}}" type="hidden" hidden>
                            <input id="hospitalId" name="hospital_id" type="hidden"
                                value="{{ $requestData['hospital_id'] }}" />
                            <input id="doctorId" name="doctor_id" type="hidden"
                                value="{{ $requestData['doctor_id'] }}" />
                                <!-- data block end -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="">
                                            Paitent Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input name="paitent_name" class="form-control" type="text"
                                            value="@if(old('paitent_name')){{old('paitent_name')}} @else{{$regUser->name ?? ''}}@endif" placeholder="name..." />
                                        @error('paitent_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for=""> Age </label>
                                        <input name="patient_age" class="form-control" type="number"
                                            value="{{ old('patient_age') }}" placeholder="name..." />
                                        @error('patient_age')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">
                                            Mobile Number
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input name="mobile" class="form-control" type="text"
                                            value="@if(old('mobile')){{old('mobile')}} @else{{$regUser->phone ?? ''}}@endif" placeholder="name..." />
                                        @error('mobile')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Doctor Sit Date </label>
                                        <select id="appoinmentDate" name="appoinment_date"
                                            class="form-control mb-2 mr-sm-2">
                                            <option selected value="">
                                                select
                                            </option>
                                            @foreach($sit_date as $dayAndDate)
                                            <option data-day="{{$dayAndDate->day}}" value="{{$dayAndDate->date}}">
                                                {{ $dayAndDate->day }}
                                                {{ $dayAndDate->date }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('appoinment_date')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="visitTime">

                            </div>
                            <div id="slotCheckResult"></div>

                            <button id="appoinmentBtn" class="btn btn-primary"   type="submit">
                                Confrim Appoinment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Single Card End -->
        </div>
        <div class="col-md-4">
            <!-- sidebar Crad Start -->

            <div class="card mt-3" style="width: 20rem">
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

@endsection @section("script")
<script>
    //   var doctorName = $("#doctorId option:selected").text();
    $(document).ready(function () {
        var hospital_id = $("#hospitalId").val();
        var doctor_id = $("#doctorId").val();
        $("#appoinmentDate").on("change", function () {
            var day = $("#appoinmentDate option:selected").data("day");
            var appoinment_date = $("#appoinmentDate option:selected").val();
            console.log(appoinment_date);
            // get visit time/shift
            $.ajax({
                url: "{{route('user.getVisitTime')}}",
                method: "GET",
                data: {
                    hospital_id: hospital_id,
                    doctor_id: doctor_id,
                    day: day,
                },
                success: function (data) {
                    if (data.success == true) {
                        var visit_type = data.visit_time;
                        if (visit_type.shift_type == "m") {
                            $("#visitTime").empty().append("<span class='badge badge-warning'>Morning Shift </span>\
                            <input type='hidden' name='shift_type' value='m' hidden>");
                        } else if (visit_type.shift_type == "e") {
                            $("#visitTime").empty().append("<span class='badge badge-warning'>Evening Shift </span>\
                            <input type='hidden' name='shift_type' value='e' hidden> ");
                        } else if (visit_type.shift_type == "d") {
                            $("#visitTime").empty().append("<span class='badge badge-warning'>Full Day Shift </span>\
                            <input type='hidden' name='shift_type' value='d' hidden> ");
                        } else if (visit_type.shift_type == "b") {
                            $("#visitTime").empty().append('<h5 class="text-danger"> Pleaes select shift</h5>\
                            <div class="row">\
                                <div class= "col-md-6">\
                                <div class="custom-control custom-radio custom-control-inline">\
                                    <input type="radio" id="morningShift" name="shift_type" class="custom-control-input" value="m">\
                                        <label class="custom-control-label" for="morningShift">Morning Shift</label>\
                                        </div>\
                                    <div class="custom-control custom-radio custom-control-inline">\
                                        <input type="radio" id="eveningShift" name="shift_type" class="custom-control-input" value="e">\
                                            <label class="custom-control-label" for="eveningShift">Evening Shift</label>\
                                        </div>\
                                    </div>\
                                </div>');
                        }


                    } //top data.success if statement end

                    //end success block
                },
            });

    //    Appoinment slot checker
    $.ajax({
            url: "{{route('user.appoinmentSlotChecker')}}",
            method: "GET",
            data: {
                hospital_id: hospital_id,
                doctor_id: doctor_id,
                appoinment_date: appoinment_date,
            },
            success: function (data) {
                if (data.success == true) {
                    $("#slotCheckResult").empty().append("<span class='text-danger'>" + data.slot_check_result +  "</span>");
                    if (data.is_btn_disabled) {
                        $("#appoinmentBtn").attr("disabled", "disabled");
                     } else {
                        $("#appoinmentBtn").removeAttr("disabled");
                     }


                }

            },
            });
            // slot chekcer end


        });
    });
</script>

@endsection
