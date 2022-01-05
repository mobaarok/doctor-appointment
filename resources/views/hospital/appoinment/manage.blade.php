@extends('hospital/layout/master')
@section('content')

    <div class="page-title mb-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Appointment Management</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('hospital.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title float-start">Appointment List</h4>
                        <button type="button" class="btn btn-dark float-end" data-bs-toggle="modal"
                            data-bs-target="#addLocalSerialModal">
                            Add Local Serial
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="fw-bold text-dark">Select Doctor</div>
                                <div class="form-group">
                                    <select id="doctorId" class="choices form-select">
                                        <option value="">Choose...</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">
                                                {{ $doctor->doctor_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fw-bold text-dark">Select Date</div>
                                <div class="form-group">
                                    <!-- <label for="basicInput">Basic Input</label> -->
                                    <input id="dateForDoctorList" type="date" value="{{ $setToday }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--row-->

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Pataient Name</th>
                                        <th>Phone</th>
                                        <th>Serial Type</th>
                                        <th>Serial Complete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!-- data will be here via ajax request -->
                                </tbody>
                            </table>
                            <h6 class="text-center text-danger">Please select Doctor and Date to get Appointmet List.</h6>
                        </div>
                    </div>
                </div>
                <!--card-->
            </div>
        </div>
        <!--row-->
    </section>

    {{-- :::::::::::::::::Add Local Serial Modal --}}
    <div class="modal fade" id="addLocalSerialModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="addLocalSerialForm" class="row g-2" action="{{ route('hospital.addLocalSerial') }}"
                        method="post">
                        @csrf
                    {{-- Hidden input --}}
                        <input name="serial_type" type="hidden" value="0" hidden>
                        <input type="hidden"  id="hospitalId" value="{{ $hospital_id }}" hidden>

                        <div class="col-12">
                            <label for="doctorSelect" class="form-label">Doctor </label>
                            <select name="doctor_id" id="modalDoctorId" class="form-select"
                                aria-label="Default select example">
                                <option value="">Select...</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-9">
                            <label for="name" class="form-label">
                                Paitent Name
                                <span class="text-danger">*</span>
                            </label>
                            <input id="name" name="paitent_name" class="form-control" type="text"
                                value="{{ old('paitent_name') }}" placeholder="name...">
                            @error('paitent_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="age" class="form-label">
                                Age
                            </label>
                            <input id="age" name="patient_age" class="form-control" type="number"
                                value="{{ old('patient_age') }}" placeholder="name...">
                            @error('patient_age')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">
                                Mobile Number
                                <span class="text-danger">*</span>
                            </label>
                            <input name="mobile" class="form-control" type="text" value="{{ old('mobile') }}"
                                placeholder="name...">
                            @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="appoinmentDate" class="col-md-6">
                            <label for="" class="form-label">Doctor Sit Date </label>
                            <select id="sitDate" name="appoinment_date" class="form-control mb-2 mr-sm-2">
                                <option selected value="">Select...</option>
                            </select>
                            @error('appoinment_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="visitTime"> {{-- Data will be here via ajax requset --}} </div>
                        <div id="slotCheckResult"> {{-- Data will be here via ajax requset --}} </div>

                        <div class="col-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- :::::::::::::::::End Add Local Serial Modal --}}


@section('script')

    <script type="text/javascript">
        //  {{-- Get Appointment List by Selectetd "Doctor" and "Date"; --}}
        $("#doctorId, #dateForDoctorList").on('change', function() {
            var doctorId = $("#doctorId option:selected").val();
            var dateForDoctorList = $("#dateForDoctorList").val();
            $.ajax({
                url: "{{ route('hospital.appoinmentList') }}",
                data: {
                    doctor_id: doctorId,
                    appoDate: dateForDoctorList,
                },
                method: "get",
                dataType: "json",
                success: function(data) {

                    var sl = 1;
                    $('tbody').empty();
                    data.book_list.forEach(item => {

                        var isCheckedText = item.is_complete == 1 ? "Complete" : "Incomplete";
                        var isVisitedClass = item.is_complete == 1 ? "bg-light-success" :
                            "bg-light-danger";
                        var isDisabled = item.is_complete == 1 ? 'disabled' : '';
                        var isChecked = item.is_complete == 1 ? 'checked' : '';

                        var serialType = item.serial_type == 1 ? 'Online' : 'Local';
                        var serialCls = item.serial_type == 1 ? "bg-light-info" :
                            "bg-light-danger";
                        $("tbody").append('<tr>\
                                    <td class="text-bold-500">' + sl++ + '</td>\
                                    <td class="text-bold-500 fw-bold">\
                                        <a href="single-doctor.html">' + item.patient_name + '</a>\
                                    </td>\
                                    <td>01634559896</td>\
                                    <td>\
                                        <div class="badge ' + serialCls + '  "> ' + serialType + ' </div>\
                                    </td>\
                                    <td class="text-bold-500">\
                                    <div class="is-visited-checkbox-parent">\
                                        <span class="badge ' + isVisitedClass + '  float-start">  ' + isCheckedText +
                            ' </span>\
                                        <div class="form-check form-switch float-start">\
                                            <input class="form-check-input is-visited-checkbox " type="checkbox" id="flexSwitchCheckDefault" data-bookingid=' + item.id + ' ' +
                            isDisabled + ' ' + isChecked + ' >\
                                        </div>\
                                    </div>\
                                    </td>\
                                </tr>');
                    });

                    $(".is-visited-checkbox").click(function(e) {
                        e.preventDefault();
                        var booking_id = $(this).attr("data-bookingid");
                        var is_visited_checkbox = $(this);
                        console.log(booking_id);

                        Swal.fire({
                            title: 'Make it Visited?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, make it done!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var url =
                                    "{{ route('hospital.appoinmentCompleteAction') }}"
                                // ajax
                                $.ajax({
                                    url: url,
                                    data: {
                                        'booking_id': booking_id,
                                        '_token': "{{ csrf_token() }}",
                                    },
                                    method: 'get',
                                    success: function(data) {
                                        console.log(data);
                                        // book_element.empty().text('Complete');
                                    },
                                });
                                //ajax end

                                $(is_visited_checkbox).parents(
                                    ".is-visited-checkbox-parent").empty().append('<span class="badge bg-light-success float-start"> Complete </span>\
                                <div class="form-check form-switch float-start">\
                                    <input class="form-check-input is-visited-checkbox" type="checkbox" id="flexSwitchCheckDefault" checked disabled>\
                                </div>');
                                Swal.fire(
                                    'Visited!',
                                    'success'
                                )
                            }
                        })
                        //    swel end
                    });


                }
            });

        });
        // end appoinment manage

        //add local serial
        var modalDoctorId = '';
        $('#modalDoctorId').on('change', function() {
            modalDoctorId = $(this).val();
            $('#sitDate').empty().append('<option value="" selected>Select...</option>');
            var url = "{{ route('hospital.getDoctorSitDate') }}"
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    'doctor_id': modalDoctorId,
                },
                success: function(data) {

                    data.forEach(element => {
                        $('#sitDate').append('<option data-day=" ' + element.day +
                            ' " value=" ' + element.date +
                            ' ">' + element.day + ' ' + element.date + '</option>')
                    })
                }
            }); //ajax
        });

        // shift manage


        // var shift_modalDoctorId = $("#modalDoctorId option:selected").val();

        $("#appoinmentDate").on("change", function() {
            var shift_hospital_id = $("#hospitalId").val();

            var day = $("#appoinmentDate option:selected").data("day");
            var appoinment_date = $("#appoinmentDate option:selected").val();

            // get visit time/shift
            $.ajax({
                url: "{{ route('user.getVisitTime') }}",
                method: "GET",
                data: {
                    hospital_id: shift_hospital_id,
                    doctor_id: modalDoctorId,
                    day: day,
                },
                success: function(data) {
                    if (data.success == true) {
                        var visit_type = data.visit_time;
                        if (visit_type.shift_type == "m") {
                            $("#visitTime").empty().append("<span class='badge bg-warning'>Morning Shift </span>\
                                <input type='hidden' name='shift_type' value='m' hidden>");
                        } else if (visit_type.shift_type == "e") {
                            $("#visitTime").empty().append("<span class='badge bg-warning'>Evening Shift </span>\
                                <input type='hidden' name='shift_type' value='e' hidden> ");
                        } else if (visit_type.shift_type == "d") {
                            $("#visitTime").empty().append("<span class='badge bg-warning'>Full Day Shift </span>\
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
                url: "{{ route('user.appoinmentSlotChecker') }}",
                method: "GET",
                data: {
                    hospital_id: shift_hospital_id,
                    doctor_id: modalDoctorId,
                    appoinment_date: appoinment_date,
                },
                success: function(data) {
                    if (data.success == true) {
                        $("#slotCheckResult").empty().append("<span class='text-danger'>" + data
                            .slot_check_result + "</span>");
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
        //shift manage end

        $('#addLocalSerialForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr('action');
            var method = $(this).attr('method');

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(data) {
                    console.log(data);
                    $("#localSerialModal").modal('hide');

                }
            });
        });
        // End
    </script>
@endsection
@endsection
