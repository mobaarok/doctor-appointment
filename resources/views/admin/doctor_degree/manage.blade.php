{{-- @extends('admin/layout/master') --}}
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
        <div class="col-md-12">
            <div class="card" style="min-height: 484px">
                <div class="card-header">
                    <h3>Degree List</h3>
                    <div class="card-header-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                            Add New
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Degree short Name</th>
                                    <th scope="col">Degree fullname</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($degrees as $degree)
                                <tr>
                                    <td>
                                        {{ $degree->degree_short_name }}
                                    </td>
                                    <td >
                                        {{ $degree->degree }}
                                    </td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="{{ route('admin.doctor-degree.edit', $degree->id) }}">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$degrees->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>




<!-- Modal -->
<div class="modal  fade" id="formModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Degree</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="educationForm" class="forms-sample" method="post" action="{{ route('admin.doctor-degree.store') }}">
                    @csrf
                    <div id="rootRow" class="">
                        <div class="form-row">
                            <div class=" form-group col-md-4">
                                <label for="">Degree short name</label>
                                <input name="degree_st_name[]" class="form-control" type="text"
                                   placeholder="Degree short name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Degree full Name</label>
                                <input name="degree[]" class="form-control" type="text"
                                    placeholder="fullname">
                            </div>
                            <div class="col-md-2">
                                <button style="margin-top: 30px;" type="button" id="addMoreRow" class="btn btn-info">Add new</button>
                            </div>

                        </div>
                    </div>
                    <p id="error" class="feedback invalid-feedback  text-danger"></p>
                    <div class="text-right">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="formSubmit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready(function () {

        $("#addMoreRow").on("click", function () {
            $("#rootRow").append('<div class="form-row"> \
                <div class="form-group col-md-4">\
                    <input name="degree_st_name[]" class="form-control" type="text"> \
                        </div> \
                    <div class="form-group col-md-6">\
                        <input name="degree[]" class="form-control" type="text"> \
                        </div> \
                        <div class="col-md-2">\
                            <button  type="button" class="removeBtn btn btn-danger">Remove</button>\
                        </div>\
                            </div>');
        });

        $("#rootRow").on('click', ".removeBtn", function () {
            $(this).parents('.form-row').remove();
        });


        $(document).on("submit", "form#educationForm", function(e){
            e.preventDefault();
            var res = $(this).serialize();
            var url  = $(this).attr('action')
             $.ajax({
                method: "POST",
                url: url,
                data: res,
                success: function (data) {
                    $('.feedback').removeClass('invalid-feedback').addClass('invalid-feedback');

                    if (data.fail == true) {
                        for (errorName in data.errors) {
                            $('#error').removeClass('invalid-feedback');
                            $('#error').html("Please Fill up all short name feild");
                        }
                    } else {
                        $('#formModal').modal('hide');
                    } //else
                }, //success method from ajax
            }); //ajax
        });
    });
</script>
@endsection

@endsection
