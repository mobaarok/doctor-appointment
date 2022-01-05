@extends('hospital/layout/master') @section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Doctors Management</h3>
            <p class="text-subtitle text-muted">For user to check they list</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Doctors</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<!-- Basic Tables start -->
<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Doctors List</h4>
                    <a class="btn btn-dark  float-end" href="{{ route('hospital.addDoctor') }}">Add Doctor</a>
                    <!-- <div class="d-flex justify-content-between ">
                        <h4 class="card-title">Doctors List</h4>
                        <a class="btn btn-info " href="">Add Doctor</a>
                    </div> -->
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p class="card-text">

                            বিস্তারিত দেখার জন্য ডাক্তার এর নামে কিল্ক করুন।
                        </p>
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Expertise</th>
                                        <th>Visit Day</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $sl = (($page - 1) * $per_page)+1; @endphp
                                    @foreach($doctors as $doctor)
                                    <tr>
                                        <td class="text-bold-500"> {{$sl++}} </td>
                                        <td class="text-bold-500 fw-bold">
                                            <a href="{{route('hospital.singleDoctor', $doctor->id)}}"> {{$doctor->doctor_name}} </a>
                                        </td>
                                        <td>
                                            @foreach($doctor->expertises as
                                            $expertise)
                                            {{$expertise->expertise_name}}
                                            @endforeach
                                        </td>
                                        <td class="text-bold-500">
                                            @foreach($doctor->visitHour as $visit)
                                            {{ $visit->bar }}
                                            @endforeach
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Basic Tables end -->
@endsection

