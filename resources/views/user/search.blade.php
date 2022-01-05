@extends('user/layout/master') @section('content') @section('css')
<style></style>
@endsection
<div>
    <div class="container">
        <div class="card m-5 border-0 shadow">
            <!-- whole card start -->
            <div class="card-body">
                <form id="filterForm" method="GET" action="{{ route('user.filter') }}" class="">
                    <div class="row border-bottom">
                        <div class="col-md-6">
                            <span class="badge badge-warning">Location: {{$location}}</span>
                            <input id="inLocation" type="hidden" name="location" value="{{$location}}" hidden>
                            <input id="inCityId" type="hidden" name="city_id" value="{{$city_id}}" hidden>
                            <input id="inDistricId" type="hidden" name="district_id" value="{{$district_id}}" hidden>
                            <input id="inDivisionId" type="hidden" name="division_id" value="{{$division_id}}" hidden>
                        </div>
                        <div class="col-md-6">
                            <!-- Search -->
                            <div class="input-group input-group-lg mb-3">
                                <input name="search_name" type="text" class="form-control" value="{{ $search }}"
                                    placeholder="Search for doctor & hospital..." aria-label="Recipient's username"
                                    aria-describedby="button-addon2" />
                                <div class="input-group-append">
                                    <button class="btn btn-info searchBtn" type="button" id="button-addon2 ">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 border-right">
                            <h5>Filter</h5>
                            <div class="form-group">
                                <label for="">Spacilist</label>
                                <select name="doctor_type" id="doctorType" class="form-control form-control-sm">
                                    <option @if(!$doctor_type) selected @endif value=" ">
                                        All
                                    </option>
                                    @foreach($expertises as $expertise)
                                    <option @if($doctor_type==$expertise->id)
                                        selected
                                        @endif
                                        value="{{$expertise->id}}"
                                        >
                                        {{$expertise->expertise_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <h3>Division</h3>
                            <nav class="nav flex-column">
                                <a class="nav-link all-bangladesh" href="#">
                                    All Bangladesh
                                </a>
                                @foreach($divisions as $division)
                                <a data-toggle="modal" data-target="#location-modal" class="nav-link" href="{{ route('getDistricts', [
                                    'division_id' => $division->id,
                                    'location'  => $division->division_name
                                    ]) }}">
                                    {{$division->division_name}}
                                </a>

                                @endforeach
                            </nav>

                        </div>
                        <div class="col-md-9">
                            <div class="doctors-block">
                                <h5>
                                    Search results for
                                    <span class="text-primary">{{ $search }}</span>...
                                </h5>

                                @if($doctors && count($doctors) > 0 )

                                <h2 class="">Doctors...</h2>
                                <ul style="max-width: 400px" class="list-group list-group-flush">
                                    @foreach($doctors as $doctor)
                                    <li class="list-group-item">
                                        <a href="{{ route('user.singleDoctor',  $doctor->id ) }}">
                                            <h4>{{$doctor->doctor_name}}</h4>
                                        </a>
                                        <div class="expertises">
                                            @foreach($doctor->expertises as $expertise)
                                            {{$expertise->expertise_name}}
                                            @endforeach
                                        </div>

                                        <div>
                                            <span>Avalaible in</span>
                                            @foreach($doctor->hospitals as $hospital)
                                            
                                                <a class="card-href" href="{{ route('user.singleHospital',  $hospital->id ) }}">
                                                    {{$hospital->hospital_name}}
                                                </a>
                                            
                                            @endforeach
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <div class="paginator">
                                    <span>
                                        <input id="pageNumber" type="hidden" name="page" value="">
                                    </span>
                                    {{$doctors->links()}}

                                </div>
                                @else
                                <h4>No Doctor Found!</h4>
                                <h5>Please search again...</h5>
                                @endif

                            </div>
                            <div class="hospital-block">
                                @if($hospitals && count($hospitals) > 0 )
                                <h3>hospitals...</h3>
                                <ul style="max-width: 400px" class="list-group list-group-flush">
                                    @foreach($hospitals as $hospital)
                                    <li class="list-group-item">
                                        <a class="card-href" href="{{ route('user.singleHospital',  $hospital->id ) }}">
                                        {{$hospital->hospital_name}}
                                        </a>
                                        
                                    </li>
                                    @endforeach
                                </ul>

                                <div class="hospital-paginator">
                                    <span>
                                        <input id="hospitalPageNumber" type="hidden" name="hospital_pagination_number"
                                            value="">
                                    </span>
                                    {{$hospitals->links()}}

                                </div>

                                @else
                                <h5>No Hospital in this search...</h5>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <input id="pageShowType" type="hidden" name="show" value="">
                </form>
            </div>
            <!-- whole card end -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="location-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body location-modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->


    </div>
</div>

@section('script')
<script>

    $("#doctorType").on("change", function (event) {
        $("form#filterForm").submit();
    });

    $(".searchBtn").on("click", function (event) {
        $("form#filterForm").submit();
    });

    $(".all-bangladesh").on("click", function (event) {
        $('#inDivisionId').val('');
        $("#inDistrictId").val('');
        $("#inCityId").val('');
        $("#inLocation").val('Bangladesh');
        $("form#filterForm").submit();
    });



    function getPageNumber(url) {
        var test1 = /\bpage=\d/g; //find somingthing like, "page=Digit number"
        var resultArray = url.match(test1);
        var resString = resultArray[0];
        var test2 = /\d/g; //find a digit number from a string
        var finalResArray = resString.match(test2);
        var finalPageNumber = finalResArray[0];
        return finalPageNumber;
    }
    //on paginatior click for doctors
    $(".paginator").on("click", "a", function (event) {
        event.preventDefault();
        var url = $(this).attr("href");

        var pageNumber = getPageNumber(url);
        $("#pageNumber").val(pageNumber);
        $("#pageShowType").val('doctors');
        $("form#filterForm").submit();
    });

    $(".hospital-paginator").on("click", "a", function (event) {
        event.preventDefault();
        var url = $(this).attr("href");
        var pageNumber = getPageNumber(url);
        $("#hospitalPageNumber").val(pageNumber);
        $("#pageShowType").val('hospitals');
        $("form#filterForm").submit();
    });
    // matching doctors string with php variable values and removing other block
    if ("doctors" == "{{$show}}") {
        $(".hospital-block").empty();
    }
    if ("hospitals" == "{{$show}}") {
        $(".doctors-block").empty();
    }


    //all about modal
    $("#location-modal").on("show.bs.modal", function (e) {
        var clickedElement = $(e.relatedTarget);
        $(this).find(".location-modal-body").empty().load(clickedElement.attr("href"));
    });

    $(".location-modal-body").on('click', '.district_id', function () {
        var url = $(this).data('url');
        $(document).find(".location-modal-body").empty().load(url);
    });

    //back
    $(".location-modal-body").on('click', '#backToDivision', function () {
        var url = $(this).data('back-division-url');
        $(document).find(".location-modal-body").empty().load(url);
    });


</script>
@endsection
@endsection