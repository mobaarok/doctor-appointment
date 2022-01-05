@extends('admin/admin_layout/master')

@section('content')

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
                        <li class="breadcrumb-item active" aria-current="page">Edit Hospital</li>
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
                        <h3>Hospital Edit Form</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST"
                            action="{{ route('admin.hospital.update', $hospital->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">

                                    <div class="form-group">
                                        <label for="Hospital Name">
                                            Hospital Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input name="hospital_name" type="text" class="form-control form-control-sm"
                                            value="{{ $hospital->hospital_name }}">
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
                                            value="{{ $hospital->mobile_phone }}">
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
                                            value="{{ $hospital->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="User Name">User Name</label>
                                        <input name="username" type="text" class="form-control form-control-sm"
                                            value="{{ $hospital->username }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="Telephone"> Telephone</label>
                                        <input name="telephone" type="text" class="form-control form-control-sm"
                                            value="{{ $hospital->telephone }}">
                                    </div>

                                </div>
                                <!--col-->

                                <div class="col">

                                    <div class="form-group">
                                        <!-- PHP Block Start -->
                                        @php
                                            $oldDivisionId = $hospital->division->id ?? '';
                                        @endphp
                                        <!-- PHP Block End -->
                                        <label for="Division">
                                            Division
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-sm" name="division" id="division">
                                            <option value="">Select...</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    {{ $division->id == $oldDivisionId ? 'selected' : '' }}>
                                                    {{ $division->division_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('division')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <!-- PHP Block Start -->
                                        @php
                                            $oldDistrictId = $hospital->district->id ?? '';
                                            $oldDistrictName = $hospital->district->district_name ?? '';
                                        @endphp
                                        <!-- PHP Block End -->
                                        <label for="District"> District</label>
                                        <select class="form-control form-control-sm" name="district" id="district">
                                            <option value="">Select...</option>
                                            @if ($oldDistrictId == true)
                                                <option value="{{ $oldDistrictId }}" selected> {{ $oldDistrictName }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('district')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <!-- PHP Block Start -->
                                        @php
                                            $oldUpazilaId = $hospital->upazila->id ?? '';
                                            $oldUpazilaName = $hospital->upazila->upazila_name ?? '';
                                        @endphp
                                        <!-- PHP Block End -->
                                        <label for="City"> City/Upazila</label>
                                        <select class="form-control form-control-sm" name="upazila" id="upazila">
                                            <option value="">Select...</option>
                                            @if ($oldUpazilaId == true)
                                                <option value="{{ $oldUpazilaId }}" selected> {{ $oldUpazilaName }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('upazila')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">

                                        <div class="form-group col">
                                            <label for="Open Time"> Open Hour</label>
                                            <input type="time" class="form-control form-control-sm" name="open_hours"
                                                value="{{ $hospital->hospital_open_time }}">
                                        </div>

                                        <div class="form-group col">
                                            <label for="Open Time"> Closing Hour</label>
                                            <input type="time" class="form-control form-control-sm" name="closing_hours"
                                                value="{{ $hospital->hospital_closing_time }}">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        <textarea class="form-control form-control-sm" name="address" id="" rows="3">{{ $hospital->address }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <input class="js-single" {{ $hospital->is_activated == 1 ? 'checked' : '' }}
                                            type="checkbox" name="is_activated">
                                        <span class="text-secondary">Active this hospital??</span>
                                    </div>

                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">
                                Update
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
        $(document).ready(function() {

            //To Get District under the selected Division
            $('#division').on('change', function() {
                $('#district').empty().append('<option value="" selected>Select...</option>');
                var division_id = $('#division').val();
                var url = "{{ route('getDistrictJson') }}"
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        'division_id': division_id,
                    },
                    success: function(data) {
                        data.districts.forEach(element => {
                            $('#district').append('<option value=" ' + element.id +
                                ' ">' + element.district_name + '</option>')
                        })
                    }
                }); //ajax
            }); //End district

            //To Get Upazila under the selected District
            $('#district').on('change', function() {
                $('#upazila').empty().append('<option value="" selected> Select... </option>');
                var district_id = $('#district').val();
                var url = "{{ route('getUpazilaJson') }}"
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        'district_id': district_id,
                    },
                    success: function(data) {
                        data.upazilas.forEach(element => {
                            $('#upazila').append('<option value=" ' + element.id +
                                ' ">' + element.upazila_name + '</option>')
                        })
                    }
                }) //ajax
            }); //End upazila

        });
    </script>

@endsection
