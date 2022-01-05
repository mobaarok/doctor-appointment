{{-- @extends('admin/layout/master') --}}
@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Expertise</h3>
            <!-- <p>taouhto</p> -->
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Expertise</li>
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
        <div class="card ">
            <div class="card-header">
                <h3>Expertise List</h3>
                <div class="card-header-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                        Add New
                    </button>
                </div>
            </div>
            <div id="tableCard" class="card-body">
                <div class="dt-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Sl.</th>
                                <th scope="col">Expertise Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sl = 1 @endphp
                            @foreach($expertise as $exp)
                            <tr>
                                <td>{{$sl ++}}</td>
                                <td>{{$exp->expertise_name}}</td>
                                <td>
                                    <button type="button" class="editBtn btn btn-info btn-icon" data-expertise_id="{{$exp->id}}"
                                        data-expertise="{{$exp->expertise_name}}">
                                        <i class="ik ik-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>




<!-- Add New Modal -->
<!-- Modal -->
<div class="modal  fade" id="formModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Expertise</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="expertiseForm" class="forms-sample" method="post"
                    action="{{ route('admin.expertise.store') }}">
                    @csrf
                    <div id="rootRow" class="">
                        <div class="my-form-row d-flex flex-row ">
                            <div class="form-group col-md-10">
                                <label for="">Expertise Name</label>
                                <input name="expertise_name[]" class="expertise form-control" type="text"
                                    placeholder="eg: medecine">
                            </div>
                            <button style="margin-top: 30px;" type="button" id="addMoreRow"
                                class="btn btn-success btn-icon">
                                <i class="ik ik-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <p id="error" class="feedback invalid-feedback  text-danger"></p>
                    <div class="text-right">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="formSubmit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Add Moal -->


<!-- Edit Modal -->
<!-- Modal -->
<div class="modal  fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Expertise</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="editExpertiseForm" class="forms-sample">
                    @csrf
                    @method('PUT')

                        <div class=" d-flex flex-row ">
                            <div class="form-group col-md-10">
                                <label for="">Expertise Name</label>
                                <input id="expertise" name="expertise_name" class=" form-control" type="text" value=""
                                    placeholder="eg: medecine">
                            </div>

                        </div>
                    <p id="error" class="feedback invalid-feedback  text-danger"></p>
                    <div class="text-right">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="faormSubmit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- End Add Moal -->


@section('script')
<script>
    $(document).ready(function () {



        $("#addMoreRow").on("click", function () {
            $("#rootRow").append('<div class="my-form-row d-flex flex-row extended"> \
                <div class="form-group col-md-10">\
                     <input name="expertise_name[]" class="expertise form-control" type="text" placeholder = "eg: medecine" >\
                </div>\
                <button type="button" class="removeBtn btn btn-danger btn-icon ">\
                    <i class="ik ik-trash-2" ></i>\
                </button>\
                            </div>');
        });

        $("#rootRow").on('click', ".removeBtn", function () {
            $(this).parents('.my-form-row').remove();
        });

        $(document).on("submit", "form#expertiseForm", function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr('action')
            $.ajax({
                method: "POST",
                url: url,
                data: formData,
                success: function (data) {
                    $('.feedback').removeClass('invalid-feedback').addClass('invalid-feedback');

                    if (data.fail == true) {
                        for (errorName in data.errors) {
                            $('#error').removeClass('invalid-feedback');
                            $('#error').html("Please Fill up all short name feild");
                        }
                    } else {
                        // $(".expertise").val("");
                        // $('.extended').remove();
                        location.reload();




                        $('#formModal').modal('hide');
                    } //else
                }, //success method from ajax
            }); //ajax
        });

        $(".editBtn").on('click', function(e){
            e.preventDefault();
            var expertise_id = $(this).data('expertise_id');
            var expertise = $(this).data('expertise');
            $("#expertise").val(expertise);
            $('#editModal').modal('show');


                $(document).on("submit", "form#editExpertiseForm", function (e) {
                e.preventDefault();

                var formData = $(this).serialize();

                var url = '{{ url("admin/expertise/") }}/'+expertise_id;
                console.log(url);
                $.ajax({
                    method: "POST",
                    url: url,
                    data: formData,
                    success: function (data) {
                    $('#editModal').find("#error").removeClass('invalid-feedback').addClass('invalid-feedback');

                        if (data.fail == true) {
                                  $('#editModal').find("#error").removeClass('invalid-feedback');
                            $('#editModal').find("#error").html("Please Fill up the feild");


                        } else {

                            location.reload();

                            $('#editModal').modal('hide');
                        } //else
                    }, //success method from ajax
                }); //ajax
            });

        });
        //edti modal


    });
</script>
@endsection

@endsection
