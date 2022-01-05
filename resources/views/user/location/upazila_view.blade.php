
<a id="backToDivision" class="nav-link btn btn-info"
 data-back-division-url="{{ route('getDistricts',  [
  'division_id' => $division_id,
  'location'  => $division_name_location
 ]) }}"
  href="#">Back</a>


  <a class="nav-link text-warning" href="{{ route('user.filter', [
      'location' => $location,
      'district_id'  => $district_id,
      ]) }}">
    All {{$location}}
  </a>

  
@foreach($upazilas as $upazila)

<!-- data-toggle="modal" data-target="#location-modal" -->
<a class="nav-link upazila_id" href="{{ route('user.filter', [
    'location' => $upazila->upazila_name, 
    'city_id' => $upazila->id,
  ]) }}">
    {{ $upazila->upazila_name }}
</a>
<!-- 'division_id' => $division_id,
'district_id' => $district_id, -->

@endforeach