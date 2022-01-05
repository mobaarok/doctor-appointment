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
                        <h4 class="card-title">Add new doctor</h4>
                    </div>
                    <div class="card-body">
                        <form
                            id="assignForm"
                            class=""
                            method="post"
                            action="{{ route('hospital.addDoctorAction') }}"
                        >
                            @csrf
                            <!-- Hidden Item -->
                            <input
                                name="hospital_id"
                                type="hidden"
                                data-idtype="Hospital Id"
                                value="{{$hospital->id}}"
                                hidden
                            />
                            @error('hospital_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <!-- Hidden Item end -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3">Doctor</label>
                                        <select
                                            name="doctor_id"
                                            class="form-control select2"
                                        >
                                            <option selected value="">
                                                Choose...
                                            </option>
                                            @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}">
                                                {{$doctor->doctor_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('doctor_id')
                                    <div
                                        style="font-size: medium"
                                        class="text-danger"
                                    >
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
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

        // $("#addMoreRow").on("click", function () {
        //     $("#bartimeRootRow").append(
        //     );
        // });

        // $("#bartimeRootRow").on("click", ".removeBtn", function () {
        //     $(this).parents(".repeat-row").remove();
        // });
    });
</script>

@endsection @endsection
