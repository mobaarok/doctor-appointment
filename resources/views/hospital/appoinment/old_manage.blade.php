@extends('hospital/layout/master')
@section('content')

<div class="main-content">
    <div class="container-fluid">

        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Appoinment Manage</h5>
                            <span>Please select a doctor</span>
                            <span>and select date to see the list</span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <!--offset-md-1-->
                <div class="card" style="min-height: 390px;">
                    <div class="card-header font-weight-bold">

                        <span style="font-size: 20px;" id="doctorName" class=" text-success"></span>
                        <div class="card-header-right">
                            <!-- Button trigger modal -->
                            <button type="button" id="addLocalSerialBtn" class="btn btn-warning" data-toggle="modal"
                                data-target="#localSerialModal">
                                Add Local Serial
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-row">
                                    <div class="input-group mb-3 col-md-5">
                                        <div class="input-group-append">
                                            <label class="input-group-text border-0 bg-success text-white" for="">
                                                Change doctor
                                            </label>
                                        </div>
                                        <select id="doctorId" class="select2 custom-select" >
                                            <option value="">Choose...</option>
                                            @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}">{{$doctor->doctor_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 col-md-5">
                                        <div class="input-group-append">
                                            <label class="input-group-text border-0 bg-success text-white" for="">
                                                Date
                                            </label>
                                        </div>
                                        <input id="appoDate" name="appo_date" type="date" value="{{$setToday}}"
                                            class="form-control">
                                    </div>

                                </div>
                            </div>


                        </div>
                        <!-- row end -->

                        <!-- tabel -->
                        <h4 class=""> Serial list </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL.</th>
                                        <th scope="col">Paitent Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Serial Complete</th>
                                        <th scope="col"> Serial Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- data will here via js -->
                                </tbody>
                            </table>
                        </div>
                        <!-- table end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Local Serial Adding  Modal -->
<div class="modal fade" id="localSerialModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addLocalSerialForm" action="{{route('hospital.addLocalSerial')}}" method="post">
                    @csrf
                    <input type="hidden" name="serial_type" value="0" hidden>
                    <div class="input-group mb-3">
                        <select name="doctor_id" id="modalDoctorId" class="select2 custom-select" style="width: 50%">
                            <option value="" selected>Choose...</option>
                            @foreach($doctors as $doctor)
                            <option value="{{$doctor->id}}">{{$doctor->doctor_name}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text border-0 bg-success text-white"
                                for="inputGroupSelect02">Select
                                doctor</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">
                                    Paitent Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="paitent_name" class="form-control" type="text"
                                    value="{{ old('paitent_name') }}" placeholder="name...">
                                @error('paitent_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">
                                    Age
                                </label>
                                <input name="patient_age" class="form-control" type="number"
                                    value="{{ old('patient_age') }}" placeholder="name...">
                                @error('patient_age')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div id="sitTime" class="col-md-6">
                            <div class="form-group">
                                <label for="">Doctor Sit Date </label>
                                <select id="sitDate" name="appoinment_date" class="form-control mb-2 mr-sm-2">
                                    <option selected value="">Select...</option>
                                </select>
                                @error('appoinment_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">
                                    Mobile Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="mobile" class="form-control" type="text" value="{{old('mobile')}}"
                                    placeholder="name...">
                                @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

        </div>

    </div>
</div>

@section('script')
<script>
    $(document).ready(function () {
        //Init select2 plugin to select tag
        $('.select2').select2();

        //get selectetd doctor serial list
        $("#doctorId, #appoDate").on('change', function () {
            var doctorId = $("#doctorId").val();
            var appoDate = $("#appoDate").val();
            var doctorName = $("#doctorId option:selected").text();
            //ternary opeator  for set doctor name
            doctorId ?   $("#doctorName").empty().text("Dr. " + doctorName) : $("#doctorName").empty();

            $.ajax({
                url: "{{route('hospital.appoinmentList')}}",
                data: {
                    doctor_id: doctorId,
                    appoDate: appoDate,
                },
                method: "get",
                dataType: "json",
                success: function (data) {

                    var sl = 1;
                    $('tbody').empty();
                    data.book_list.forEach(item => {

                        var isChecked = item.is_complete == 1 ? "Complete" : "Incomplete";
                         var cls = item.is_complete == 1 ? "btn-success" : "btn-danger";
                        var isDisabled = item.is_complete == 1 ? 'disabled' : '';

                        var serialType = item.serial_type == 1 ? 'Online' : 'Local';
                        var serialCls = item.serial_type == 1  ? "badge-info" : "badge-warning";
                        $("tbody").append('<tr> \
                        <td>' + sl++ + '</td> \
                        <td>' + item.patient_name + '</td> \
                        <td>' + item.patient_phone + '</td> \
                        <td> \
                         <button type="button" class="complete btn btn-sm  '+ cls +' " data-bookingid='  + item.id +' '+ isDisabled +'> '+ isChecked +' </button>\
                        <td> <span class="badge '+ serialCls +' ">' + serialType +  '</span> </td> \
                         </tr>');
                    });


                           $(".complete").click(function (e) {
                                 var booking_id = $(this).attr("data-bookingid");
                                 var book_element = $(this);
                                  console.log(booking_id);
                        $.confirm({
                            title: 'Confirm!',
                            content: 'Simple confirm!',
                            buttons: {
                                confirm: function () {
                                    var url = "{{route('hospital.appoinmentCompleteAction') }}"
                                    $.ajax({
                                        url: url,
                                        data: {
                                            'booking_id': booking_id,
                                            '_token': "{{ csrf_token() }}",
                                        },
                                        method: 'get',
                                        success: function (data) {
                                            console.log(data);
                                            book_element.empty().text('Complete');
                                        },
                                    });
                                //ajax end
                                },
                                cancel: function () {


                                },

                            }
                        });
                    });
                    //alert box end



                }
            });

        });

        //Get
        $('#modalDoctorId').on('change', function () {
            var modalDoctorId = $(this).val();
            $('#sitDate').empty().append('<option value="" selected>Select...</option>');
            var url = "{{route('hospital.getDoctorSitDate')}}"
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    'doctor_id': modalDoctorId,
                },
                success: function (data) {
                    data.forEach(element => {
                        $('#sitDate').append('<option value=" ' + element +
                            ' ">' + element + '</option>')
                    })
                }
            }); //ajax
        }); //End district

        $('#addLocalSerialForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr('action');
            var method = $(this).attr('method');

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function (data) {
                    $("#localSerialModal").modal('hide');

                }
            });
        });
        // End 



    });

</script>
@endsection
@endsection
