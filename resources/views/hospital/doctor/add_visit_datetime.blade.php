@extends('hospital/layout/master') @section('content')

<div class="main-content">
    <div class="container-fluid">
        @if (session('message'))
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div
                    class="alert alert-{{
                        session('messageType')
                    }} alert-dismissible fade show"
                    role="alert"
                >
                    <strong class="text-dark">{{ session("message") }}</strong>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-9">
                <!--offset-md-1-->
                <div class="card" style="min-height: 560px">
                    <div class="card-header font-weight-bold">
                        <h4 class="card-title">Visit Day Time</h4>
                    </div>
                    <div class="card-body">
                        <h4> Doctor {{ $doctor->doctor_name }}</h4>
                        <form
                            id="assignForm"
                            class=""
                            method="post"
                            action="{{ route('hospital.visitDayTimeAction') }}"
                        >
                            @csrf
                            <!-- Hidden Item -->
                            <input
                                name="hospital_id"
                                type="hidden"
                                value="{{$hospital->id}}"
                                hidden
                            />
                            @error('hospital_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                              <input
                                name="doctor_id"
                                type="hidden"
                                value="{{$doctor->id}}"
                                hidden
                            />
                            @error('doctor_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <!-- Hidden Item end -->



                               <div class="row">
                                   <div class="col-md-6">
                                         <div class="form-group">
                                        <label for="">Day</label>
                                        <select name="bartime" class="form-control">
                                            <option selected value="">
                                                Choose..
                                            </option>
                                            @foreach($barTime as $bar)
                                            <option value="{{ $bar }}">
                                                {{ $bar }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                   </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3">Visit Type</label>
                                        <select id="visitType" name="visit_type" class="form-control select2">
                                            <option selected value="">
                                                Choose...
                                            </option>
                                            <option value="m">Morning </option>
                                            <option value="e">Evening </option>
                                            <option value="b">Morning and Evening </option>
                                            <option value="d">Full Day</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="visitTime">

                            </div>




                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <h4 class="card-title">Help</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-primary">
                            In this form can add new doctor to hospital. system
                            is filled...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(document).ready(function () {
        $(".select2").select2();
 var visitType = "";
        $("#visitType").on("change", function () {
            visitType = $(this).val();
            console.log(visitType);
            if (visitType == "m") {
                  $("#visitTime").empty().append(morning);
            } else if (visitType == "e") {
                $("#visitTime").empty().append(evening);
            } else if (visitType == "d") {
                $("#visitTime").empty().append(fullday);
            } else if (visitType == "b") {
                $("#visitTime").empty().append(morning_evening);
            } else {
                $("#visitTime").empty();
            }
        });
        // $("#bartimeRootRow").on("click", ".removeBtn", function () {
        //     $(this).parents(".repeat-row").remove();
        // });
    });

var morning = '<div class="col-md-6">\
    <div class="row morning">\
        <div class="col-md-6">\
            <div class="form-group">\
                <label for="">Visit start hour</label>\
                <input name="m_start_time" type="time" class="form-control" />\
            </div>\
        </div>\
        <div class="col-md-6">\
            <div class="form-group">\
                <label for="">Visit end hour</label>\
                <input name="m_end_time" type="time" class="form-control" />\
            </div>\
        </div>\
    </div>\
</div>';
var evening = '<div class="col-md-6">\
    <div class="row evening">\
        <div class="col-md-6">\
            <div class="form-group">\
                <label for="">Evening Visit start </label>\
                <input name="e_start_time" type="time" class="form-control" />\
            </div>\
        </div>\
        <div class="col-md-6">\
            <div class="form-group">\
                <label for=""> Evening Visit end hour</label>\
                <input name="e_end_time" type="time" class="form-control" />\
            </div>\
        </div>\
    </div>\
</div>';
var fullday = '<div class="col-md-6">\
    <div class="row Fullday">\
        <div class="col-md-6">\
            <div class="form-group">\
                <label for="">Fullday Visit start </label>\
                <input name="d_start_time" type="time" class="form-control" />\
            </div>\
        </div>\
        <div class="col-md-6">\
            <div class="form-group">\
                <label for=""> Fullday Visit end hour</label>\
                <input name="d_end_time" type="time" class="form-control" />\
            </div>\
        </div>\
    </div>\
</div>';
var morning_evening = '<div class="row">\
    <div class="col-md-6">\
        <div class="row morning">\
            <div class="col-md-6">\
                <div class="form-group">\
                    <label for="">Morning Visit start hour</label>\
                    <input name="m_start_time" type="time" class="form-control" />\
                </div>\
            </div>\
            <div class="col-md-6">\
                <div class="form-group">\
                    <label for="">Visit end hour</label>\
                    <input name="m_end_time" type="time" class="form-control" />\
                </div>\
            </div>\
        </div>\
    </div>\
    <div class="col-md-6">\
        <div class="row evening">\
            <div class="col-md-6">\
                <div class="form-group">\
                    <label for="">Evening Visit start hour</label>\
                    <input name="e_start_time" type="time" class="form-control" />\
                </div>\
            </div>\
            <div class="col-md-6">\
                <div class="form-group">\
                    <label for=""> Evening Visit end hour</label>\
                    <input name="e_end_time" type="time" class="form-control" />\
                </div>\
            </div>\
        </div>\
    </div>\
</div>';
</script>

@endsection @endsection



                                   <!-- <div class="col-md-6">
                                        <div class="row morning">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Visit start
                                                        hour</label>
                                                    <input name="m_start_time" type="time" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Visit end
                                                        hour</label>
                                                    <input name="m_end_time" type="time" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
