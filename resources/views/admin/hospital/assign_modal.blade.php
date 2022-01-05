@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Hospitals Management</h3>
            <!-- <p>taouhto</p> -->
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hospital.index') }}">Hospitals</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assign Doctor</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
        <!-- @if (session('message'))
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="alert alert-{{ session('messageType') }} alert-dismissible fade show" role="alert">
                    <strong class="text-dark">{{ session("message") }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif -->
<section class="section">
        <div class="row">
            <div class="col-md-8">
                <div class="card" style="min-height: 454px">
                    <div class="card-header">
                        <h3>Assign Doctor to  <span class="text-info">{{$hospital->hospital_name}}</span></h3>
                        <div class="card-header-right">

                        </div>
                    </div>
                    <div class="card-body">
                        <form id="assignForm" class="" method="post" action="{{ route('admin.assign.doctor.action')}}">
                            @csrf
                            <!-- Hidden Item -->
                            <input name="hospital_id" type="hidden" data-idtype="Hospital Id" value="{{$hospital->id}}"
                                hidden />
                            @error('hospital_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <!-- Hidden Item end -->

                            <div class="row">
                                <div class="col-md-6 offset-md-3 ">
                                    <div class="form-group">
                                        <label for="inputEmail3">Doctor
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="doctor_id" class="form-control">
                                            <option selected value="">select</option>
                                            @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}">
                                                {{$doctor->doctor_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('doctor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@section('script')
<script>

    /*::::::::::::::::::::::::::::::
    Laravel Session Messages shown by toastr.js
    ::::::::::::::::::::::::::::::::::*/
    // toastr option

    // toastr option end
    @if (Session:: has('message'))
    var type = "{{ Session::get('messageType') }}";
    switch (type) {
        case 'success':
            Toastify({
                    text: "{{ Session::get('message') }}",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
            break;
        case 'danger':
        Toastify({
                    text: "{{ Session::get('message') }}",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
            break;
    }
    @endif
/*::::::::::::::::::::::::::::::
    Laravel Session Messages shown by toastr.js
    ::::::::::::::::::::::::::::::::::*/
</script>

@endsection

@endsection
