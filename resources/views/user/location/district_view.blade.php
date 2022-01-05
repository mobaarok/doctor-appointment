<!-- District View -->

<a class="nav-link text-warning" 
href="{{ route('user.filter', [
    'location' => $location,
    'division_id'  => $division_id,
    ]) }}">
All {{$location}}
</a>

    @foreach($districts as $district)
    <a class="nav-link district_id" data-url="{{ route('getUpazilas', [
            'district_id' => $district->id, 
            'division_id' => $district->division_id,
            'division_name_location' => $location,
            'location'  => $district->district_name,
            ]) }}" href="#">
        {{ $district->district_name }}
    </a>
    @endforeach