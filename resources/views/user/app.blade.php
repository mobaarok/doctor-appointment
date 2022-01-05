@extends('user/layout/master')
@section('content')
@section('css')
<style>

</style>
@endsection
<div>
  <div class="div" style="width: 300px;">
    
  </div>
    <div class="container">

        <div class="row">
            <div class="col-md-8">

 <!-- slider -->
 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('s1.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('s2.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('s1.jpg')}}" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- slidre -->

            </div>
            <div class="col-md-4">

                <h3>Areas in feni</h3>
                <nav class="nav flex-column">
                    @foreach($cities as $city)
                    <a class="nav-link upazila_id" href="{{ route('user.filter', [
                    'location' => $city->upazila_name,
                    'city_id' => $city->id,
                    ]) }}">

                        {{$city->upazila_name}}
                  </a>

                    @endforeach
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron jumbotron-fluid bg-white mt-2">
                    <div class="container">
                        <h1 class="">ডাক্তার এর সিরিয়াল নেওয়া এখন একদম সহজ</h1>
                        <h2>ঘরে বসেই</h2>
                        <h4>সার্চ করুন আর সিরিয়াল নিন</h4>

                        <form method="GET" action="{{ route('user.filter') }}" class="">
                            <div class="input-group input-group-lg mb-3">
                                <input name="search_name" type="text" class="form-control"
                                    placeholder="Search for doctor & hospital..." aria-label="Recipient's username"
                                    aria-describedby="button-addon2">
                                <input type="hidden" name="location" value="Bangladesh" hidden>
                                <div class="input-group-append">
                                    <button class="btn btn-search" type="submit" id="button-addon2">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <h2 style="display: inline-block;" class="">Hospital in Feni... </h2>
            <a style="float:right;" class="btn btn-info" href="{{route('user.filter', [
            'district_id' => 20,
             'location= Feni',
             'show' => 'hospitals',
             'page' => 1,
             ])}}">
                View all
            </a>
        </div>
        <!-- hosptal start -->
        <div class="row">
            @foreach($hospitals as $hospital)
            <div class="col-md-4">

                    <div class="card border-0 shadow-sm my-2" style="width: 23rem;">
                        <div class="card-body">
                            <a class="card-href" href="{{ route('user.singleHospital',  $hospital->id ) }}">
                            <h4 class="card-title">{{$hospital->hospital_name}}</h4>
                        </a>
                            <p class="text-muted"> <small>
                                    {{$hospital->upazila->upazila_name ?? ''}},
                                    {{$hospital->district->district_name ?? ''}},
                                    {{$hospital->division->division_name ?? ''}}
                                </small> </p>
                        </div>
                    </div>

            </div>
            @endforeach
        </div>
        <!-- hospital end -->


        <div class="mt-5">
            <h2 style="display: inline-block;" class="mt-">Doctor's in Feni... </h2>
            <a style="float:right;" class="btn btn-info" href="{{route('user.filter', [
                                    'district_id' => 20,
                                     'location= Feni',
                                     'show' => 'doctors',
                                     'page' => 1,
                                     ])}}">
                View all
            </a>
        </div>
        <!-- hosptal start -->
        <div class="row">
            @foreach($doctors as $doctor)
            <div class="col-md-4">
                <div class="card shadow-sm border-0  my-2" style="width: 23rem;">
                    <div class="card-body">
                        <a class="card-href" href="{{ route('user.singleDoctor',  $doctor->id ) }}">
                            <h4 class="card-title text-success">{{$doctor->doctor_name}}</h4>
                        </a>
                        <p>
                            @foreach( $doctor->expertises as $expertise)
                            <span>
                                {{$expertise->expertise_name ?? ' '}}
                            </span>
                            @endforeach
                        </p>
                        <p>
                            @foreach($doctor->qualifications as $qualification)
                            {{$qualification->degree->degree_short_name}}

                            <span>({{$qualification->institute->institute_short_name}})</span>
                            @endforeach
                        </p>
                        <p>Abalaible in </p>
                        <span>
                            @foreach($doctor->hospitals as $hospital)
                            <a class="card-href" href="{{ route('user.singleHospital',  $hospital->id ) }}">
                                <span> {{$hospital->hospital_name}} </span>
                            </a>
                            @endforeach
                        </span>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        <!-- doctor end -->



        <!-- Modal -->
        <!-- <div class="modal fade" id="location-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- modal end -->





    </div>
</div>



@section('script')


<script type="text/javascript">

    // $("#location-modal").on("show.bs.modal", function (e) {
    //     var clickedElement = $(e.relatedTarget);
    //     $(this).find(".modal-body").empty().load(clickedElement.attr("href"));
    // });

    // $(".modal-body").on('click', '.district_id', function () {
    //     var url = $(this).data('url');
    //     $(document).find(".modal-body").empty().load(url);
    // });

    //back
    // $(".modal-body").on('click', '#backToDivision', function () {
    //     var url = $(this).data('back-division-url');

    //     $(document).find(".modal-body").empty().load(url);
    // });

</script>
@endsection
@endsection
