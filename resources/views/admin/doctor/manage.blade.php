@extends('admin/layout/master') @section('content')

<div class="main-content">
    <div class="container-fluid">
        {{-- Page Header && Breadcrumb Start --}}
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-align-right bg-secondary"></i>
                        <div class="d-inline">
                            <h5>Doctor</h5>
                            <span>All doctor list, and it's settings.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- Page Header && Breadcrumb end --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 484px">
                    <div class="card-header">
                        <h3>Doctor List</h3>
                        <div class="card-header-right">
                            <a class="btn btn-primary" href="{{route('admin.doctor.create')}}">Add New
                                Doctor</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL.</th>
                                        <th scope="col">Doctor Name</th>
                                        <th scope="col">Expertise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl = 1 @endphp
                                    @foreach($doctors as $doctor)
                                    <tr>
                                        <th class="text-secondary" scope="row">{{$sl++}}</th>
                                        <td>{{$doctor->doctor_name}}</td>
                                        <td>{{ $doctor->expertise }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$doctors->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection