@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Doctors</h3>
            <!-- <p>taouhto</p> -->
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Doctors</li>
                </ol>
            </nav>
        </div>
    </div>
</div>




<section class="section">

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 484px">

                    <div class="card-header">
                        <h4 class="card-title float-start">Doctor List</h4>
                        <a class="btn btn-dark  float-end" href="{{route('admin.doctor.create') }}">
                            Add New Doctor
                        </a>
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
                                        <td>

                                            @foreach ($doctor->expertises as $expertise )
                                                {{$expertise->expertise_name}}
                                            @endforeach
                                        </td>
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
</section>

@endsection
