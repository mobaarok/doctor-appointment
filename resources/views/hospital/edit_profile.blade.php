@extends('hospital/layout/master')
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--offset-md-1-->
                <div class="card" style="min-height: 390px;">
                    <div class="card-header font-weight-bold">
                        <h3>Control Panel</h3>
                    </div>
                    <div class="card-body">
                            <form method="POST" action="{{route('hospital.updateHospital', $hospital->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Hospital Name</label>
                                        <input name="hospital_name" type="text" class="form-control" value="{{$hospital->hospital_name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>System User Name</label>
                                        <input name="username" type="text" class="form-control" value="{{$hospital->username}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Optional Title</label>
                                    <input name="optional_title" type="text" class="form-control" value="{{$hospital->optional_title}}">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Mobile</label>
                                        <input name="mobile_phone" type="text" class="form-control" value="{{$hospital->mobile_phone}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Telephone</label>
                                        <input name="telephone" type="text" class="form-control" value="{{$hospital->telephone}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Address </label>
                                    <input name="address" type="text" class="form-control" value="{{$hospital->address}}">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Open Hour {{$hospital->hospital_closing_time->isoFormat('hh mm A')}} </label>
                                        <input name="open_hour" type="time" class="form-control" 
                                        
                                        value="{{$hospital->hospital_open_time->isoFormat('hh:mm')}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Closing Hour </label>
                                        <input name="closing_hour" type="time" class="form-control" value="{{$hospital->hospital_closing_time}}">
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <!-- PHP Block Start -->
                                        @php $oldDivisionId = $hospital->division->id ?? '' @endphp
                                        <!-- PHP Block End -->
                                        <label for="inputCity">Division</label>
                                        <select name="division" id="division" class="form-control">
                                            <option value=''>Choose...</option>
                                            @foreach($divisions as $division)
                                            <option value="{{$division->id}}" {{  $division->id == $oldDivisionId ? 'selected' : '' }}>
                                                {{$division->division_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <!-- PHP Block Start -->
                                        @php
                                        $oldDistrictId = $hospital->district->id ?? '';
                                        $oldDistrictName = $hospital->district->district_name ?? '';
                                        @endphp
                                        <!-- PHP Block End -->
                                        <label for="inputState">District</label>
                                        <select name="district" id="district" class="form-control">
                                            <option value="">Choose...</option>
                                            @if($oldDistrictId == true)
                                            <option value="{{$oldDistrictId}}" selected> {{$oldDistrictName}} </option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <!-- PHP Block Start -->
                                        @php
                                        $oldUpazilaId = $hospital->upazila->id ?? '';
                                        $oldUpazilaName = $hospital->upazila->upazila_name ?? '';
                                        @endphp
                                        <!-- PHP Block End -->
                                        <label for="inputZip">Upazila</label>
                                        <select name="upazila" id="upazila" class="form-control">
                                            <option value="">Choose...</option>
                                            @if($oldUpazilaId == true)
                                            <option value="{{$oldUpazilaId}}" selected> {{$oldUpazilaName}} </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Update</button>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('script')
<script>
    $(document).ready(function () {

        //To Get District under the selected Division
        $('#division').on('change', function () {
            $('#district').empty().append('<option value="" selected>Select...</option>');
            var division_id = $('#division').val();
            var url = "{{route('hospital.getDistrict')}}"
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    'division_id': division_id,
                },
                success: function (data) {
                    data.districts.forEach(element => {
                        $('#district').append('<option value=" ' + element.id +
                            ' ">' + element.district_name + '</option>')
                    })
                }
            }); //ajax
        }); //End district

        //To Get Upazila under the selected District
        $('#district').on('change', function () {
            $('#upazila').empty().append('<option value="" selected> Select... </option>');
            var district_id = $('#district').val();
            var url = "{{route('hospital.getUpazila')}}"
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

    });

</script>
@endsection
@endsection
