@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Doctors</h3>
            <!-- <p>taouhto</p> -->
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.doctor.index') }}">Doctors</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add Doctor
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    @if (session('message'))
    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div
                class="alert alert-session('messageType') }} alert-dismissible fade show"
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
        <div class="col-md-12">
            <div class="card" style="min-height: 484px">
                <div class="card-header">
                    <h3>Add New Doctor</h3>
                </div>
                <div class="card-body">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <form
                                class="row g-3"
                                method="post"
                                action="{{ route('admin.doctor.store') }}"
                            >
                                @csrf

                                    <div class="col-md-6">
                                        <label for="">
                                            Doctor Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            name="doctor_name"
                                            class="form-control"
                                            type="text"
                                            value="{{ old('doctor_name') }}"
                                            placeholder="name..."
                                        />
                                        @error('doctor_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for=""> Email </label>
                                        <input
                                            name="email"
                                            class="form-control"
                                            type="text"
                                            value="{{ old('email') }}"
                                            placeholder="name..."
                                        />
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for=""> Designation </label>
                                        <input
                                            name="designation"
                                            class="form-control"
                                            type="text"
                                            value="{{ old('designation') }}"
                                            placeholder="name..."
                                        />
                                        @error('designation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                <div id="expertiseRootRow" class="">
                                    <div class="my-form-row d-flex flex-row">
                                        <div class="form-group col-md-4 pl-0">
                                            <label for="">Expertise Name</label>
                                            <select
                                                name="expertise_name[]"
                                                class="expertise form-control"
                                                id=""
                                            >
                                                <option value="">
                                                    Choose...
                                                </option>
                                                @foreach ($expertises as
                                                $expertise)
                                                <option
                                                    value="{{ $expertise->id }} "
                                                >
                                                    {{ $expertise->expertise_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button
                                            style="margin-top: 30px;"
                                            type="button"
                                            id="addMoreExpertise"
                                            class="btn btn-success"
                                        >
                                            Add
                                        </button>
                                    </div>
                                </div>

                                <div id="rootRow" class="">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="">Degree </label>
                                            <select
                                                class="form-control"
                                                name="degree_name[]"
                                                id=""
                                            >
                                                @foreach ($degrees as $degree)
                                                <option
                                                    value="{{ $degree->id }}"
                                                >
                                                    {{ $degree->degree_short_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Institute </label>
                                            <select
                                                class="form-control"
                                                name="institute_name[]"
                                                id=""
                                            >
                                                @foreach ($institutes as
                                                $institute)
                                                <option
                                                    value="{{ $institute->id }} "
                                                >
                                                    {{ $institute->institute_short_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button
                                                style="margin-top: 30px"
                                                type="button"
                                                id="addMoreRow"
                                                class="btn btn-info"
                                            >
                                                Add new
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-primary mr-2"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('script')
<script>
    $(document).ready(function () {
        $("#addMoreExpertise").on("click", function () {
            $("#expertiseRootRow").append(
                '<div class="my-form-row d-flex flex-row extended"> \
                                <div class="form-group col-md-4 pl-0">\
                                    <select name="expertise_name[]" class="expertise form-control" id="">\
                                        <option value = ""> Choose...</option >\
                                        @foreach ($expertises as $expertise)\
                                            <option value="{{ $expertise->id }} ">\
                                                {{ $expertise->expertise_name }} </option>\
                                        @endforeach\
                                    </select>\
                                </div>\
                                <button type="button" class="expertiseRemoveBtn btn btn-danger btn-icon ">\
                                    <i class="ik ik-trash-2" ></i>\
                                </button>\
                                            </div>'
            );
        });

        $("#expertiseRootRow").on("click", ".expertiseRemoveBtn", function () {
            $(this).parents(".my-form-row").remove();
        });

        $("#addMoreRow").on("click", function () {
            $("#rootRow").append(
                '<div class="form-row">\
                                                        <div class=" form-group col-md-4">\
                                                            <label for="">Degree </label>\
                                                            <select class="form-control" name="degree_name[]">\
                                                                @foreach ($degrees as $degree)\
                                                                    <option value="{{ $degree->id }}">{{ $degree->degree_short_name }} </option>\
                                                                @endforeach\
                                                            </select>\
                                                        </div>\
                                                        <div class=" form-group col-md-4">\
                                                            <label for="">Institute </label>\
                                                            <select class="form-control" name="institute_name[]" id="">\
                                                                @foreach ($institutes as $institute)\
                                                                    <option value="{{ $institute->id }}">{{ $institute->institute_short_name }} </option>\
                                                                @endforeach\
                                                            </select>\
                                                        </div>\
                                                        <div class="col-md-2">\
                                                              <button style="margin-top: 30px;" type="submit" class="removeBtn btn btn-warning"> Remove</button> \
                                                        </div>\
                                                    </div>'
            );
        });

        $("#rootRow").on("click", ".removeBtn", function () {
            $(this).parents(".form-row").remove();
        });
    });
</script>
@endsection @endsection
