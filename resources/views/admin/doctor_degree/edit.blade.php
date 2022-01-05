@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Degree</h3>
            <!-- <p>taouhto</p> -->
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Degree</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
        @if (session('message'))
        <div class="alert alert-{{ session('messageType') }}" role="alert">
            {{ session("message") }}
        </div>
        @endif
        <section class="section">
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
        </section>

@endsection
