@extends('admin/layout/master')
@section('content')

<div class="main-content">
    <div class="container-fluid">

        @if (session('message'))
        <div class="alert alert-{{ session('messageType') }}" role="alert">
            {{ session("message") }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card" style="min-height: 384px">
                    <div class="card-header">
                        <h3>Education Edit Form</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="post" action="{{ route('admin.doctor-degree.update', $degree->id) }}">
                            @csrf
                            @method("PUT")
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">
                                    Degree short name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input name="degree_short_name" class="form-control" type="text"
                                        value="{{ $degree->degree_short_name }}" placeholder="name...">
                                    @error('degree_short_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">
                                    Degree full name
                                </label>
                                <div class="col-sm-9">
                                    <input name="degree" class="form-control" type="text" value="{{ $degree->degree }}"
                                        placeholder="name...">

                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mr-2">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
