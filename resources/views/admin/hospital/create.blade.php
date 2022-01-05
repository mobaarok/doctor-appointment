@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Hospitals</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hospital.index') }}">Hospitals</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Hospital</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Hospital Creation Form</h3>
                </div>
                <div class="card-body">
                    <form class="" method="POST" action="{{ route('admin.hospital.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col">

                                <div class="form-group">
                                    <label for="Hospital Name">
                                        Hospital Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="hospital_name" type="text" class="form-control form-control-sm"
                                        value="{{ old('hospital_name') }}" placeholder="e.g: Madilab Hospital Ltd.">
                                    @error('hospital_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Mobile">
                                        Mobile
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="mobile_phone" type="text" class="form-control form-control-sm"
                                        value="{{ old('mobile_phone') }}" placeholder="e.g: 01635449686">
                                    @error('mobile_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Email">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="email" type="email" class="form-control form-control-sm"
                                        value="{{ old('email') }}" placeholder="e.g: admin@madilab.com">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="User Name">User Name</label>
                                    <input name="username" type="text" class="form-control form-control-sm"
                                        value="{{ old('username') }}" placeholder="your username">
                                </div>

                                <div class="form-group">
                                    <label for="password">
                                        Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="password" type="text" class="form-control form-control-sm"
                                        placeholder="*****">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">
                                        Re Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="password_confirmation" type="text" class="form-control form-control-sm"
                                        placeholder="*****">
                                    @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <!--col-->

                            <div class="col">
                                <div class="form-group">
                                    <label for="Telephone"> Telephone</label>
                                    <input name="telephone" type="text" class="form-control form-control-sm"
                                        value="{{ old('telephone') }}" placeholder="e.g: 32322552">
                                </div>

                                <div class="form-group">
                                    <label for="Division">
                                        Division
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control form-control-sm" name="division" id="division">
                                        <option value="">Select...</option>
                                        @foreach ($divisions as $division)
                                        <option @if (old('division')==$division->id)
                                            selected
                                            @endif
                                            value="{{ $division->id }}"
                                            >
                                            {{ $division->division_name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('division')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="District"> District</label>
                                    <select class="form-control form-control-sm" name="district" id="district">
                                        <option value="" selected>Select...</option>
                                    </select>
                                    @error('district')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="City"> City/Upazila</label>
                                    <select class="form-control form-control-sm" name="upazila" id="upazila">
                                        <option value="" selected>Select...</option>
                                    </select>
                                    @error('upazila')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <label for="Open Time"> Open Hour</label>
                                        <input type="time" class="form-control form-control-sm" name="open_hours"
                                            value="{{ old('open_hours') }}">
                                    </div>
                                    <div class="form-group col">
                                        <label for="Open Time"> Closing Hour</label>
                                        <input type="time" class="form-control form-control-sm" name="closing_hours"
                                            value="{{ old('closing_hours') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <textarea class="form-control" name="address" id=""
                                        rows="3">{{ old('address') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <input class="js-single" type="checkbox" name="is_activated">
                                    <span class="text-secondary">Active this hospital??</span>
                                </div>

                            </div>
                            <!--col-->
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('script')

<script>
    $(document).ready(function () {

        //To Get District under the selected Division
        function getDistrict(division_id) {
            $('#district').empty().append('<option value="" selected>Select...</option>');
            var url = "{{ route('getDistrictJson') }}"
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    'division_id': division_id,
                },
                success: function (data) {
                    data.districts.forEach(element => {
                        $('#district').append('<option value=" ' + element.id + ' ">' +
                            element.district_name + '</option>')
                    })
                }
            }); //ajax
        }
        //get distirct for the 1st time page load if division selected
        var division_id = $('#division').val();
        if (division_id) {
            getDistrict(division_id);
        }
        //on change
        $('#division').on('change', function () {
            var division_id = $('#division').val();
            getDistrict(division_id);
        }); //End district

        //To Get Upazila under the selected District
        $('#district').on('change', function () {
            $('#upazila').empty().append('<option value="" selected> Select... </option>');
            var district_id = $('#district').val();
            var url = "{{ route('getUpazilaJson') }}"
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    'district_id': district_id,
                },
                success: function (data) {
                    data.upazilas.forEach(element => {
                        $('#upazila').append('<option value=" ' + element.id +
                            ' ">' + element.upazila_name + '</option>')
                    })
                }
            }) //ajax
        }); //End upazila

        /*::::::::::::::::::::::::::::::
            Laravel Session Messages shown by toastr.js
            ::::::::::::::::::::::::::::::::::*/

            @if (Session:: has('message'))
            var type = "{{ Session::get('messageType') }}";
            switch (type) {
                case 'success':
                Toastify({
                        text: "{{ Session::get('message') }}",
                        duration: 3000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    break;
                case 'danger':
                Toastify({
                        text: "{{ Session::get('message') }}",
                        duration: 3000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    break;
            }
            @endif
    /*::::::::::::::::::::::::::::::
                Laravel Session Messages shown by toastr.js
                ::::::::::::::::::::::::::::::::::*/


    });
</script>

@endsection
