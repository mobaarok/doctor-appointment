<?php

namespace App\Http\Controllers;

use App\Repositories\LocationRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $location;
    public function __construct(LocationRepository $locationRepository)
    {
        $this->location = $locationRepository;
    }

    public function getDistricts(Request $request, $division_id)
    {
        $districts = $this->location->getDistirctByDivisionId($division_id);
        return view('user.location.district_view', [
            "districts" => $districts,
            "location" => $request->location,
            'division_id'  => $division_id,
        ]);
    }

    public function getUpazilas(Request $request, $district_id)
    {
        $upazilas = $this->location->getUpazilaByDistrictId($district_id);
        return view('user.location.upazila_view', [
            'upazilas' => $upazilas,
            'division_id' => $request->division_id,
            'district_id' => $district_id,
            'division_name_location' => $request->division_name_location,
            'location' => $request->location,
        ]);
    }


    public function getDistrictsJson(Request $request)
    {
        $division_id = $request->division_id;
        $districts = $this->location->getDistirctByDivisionId($division_id);
        return response()->json(["districts" => $districts], 200);
    }

    public function getUpazilasJson(Request $request)
    {
        $district_id = $request->district_id;
        $upazilas = $this->location->getUpazilaByDistrictId($district_id);
        return response()->json(["upazilas" => $upazilas], 200);
    }

}
