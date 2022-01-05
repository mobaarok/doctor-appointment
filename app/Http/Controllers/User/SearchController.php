<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Expertise;
use App\Repositories\LocationRepository;
use App\Search\SearchDoctor;
use App\Search\SearchHospital;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $locationRepositroy;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepositroy = $locationRepository;
    }

    public function search(Request $request)
    {
   
        $exertises = Expertise::get();
        $divisions = $this->locationRepositroy->getAllDivision();
        $doctors = SearchDoctor::apply($request);
        $hositals = SearchHospital::apply($request);
        
        $data = [
            'search' => $request->input('search_name'),
            'doctor_type' => $request->input('doctor_type'),
            'city_id' => $request->input('city_id'),
            'district_id' => $request->input('district_id'),
            'division_id' => $request->input('division_id'),
            'location' => $request->input('location'),
            'expertises' => $exertises,
            'divisions' => $divisions,
            'doctors' => $doctors,
            'hospitals' => $hositals,
            'show'  => $request->input('show'),
        ];
        return view('user.search', $data);
    }

    public function filter(Request $request)
    {
        //dd($request->all());
        $search = $request->input('search_name');
        $doctor_type = $request->input('doctor_type');
        $city_id = $request->input('city_id');
        $district_id = $request->input('district_id');
        $division_id = $request->input('division_id');
        $location = $request->input('location');
        $page = $request->input('page');
        $hospital_pagination_number = $request->input('hospital_pagination_number');
        $pageShowType = $request->input('show');

        $pageQuery = "";
        if (!empty($page)) {
            $pageQuery .= '&page=' . $page;
        }

        $hospitalPaginationQuery = "";
        if (!empty($hospital_pagination_number)) {
            $hospitalPaginationQuery .= '&page=' . $hospital_pagination_number;
        }

        $searchQuery = "";
        if (!empty($search)) {
            $searchQuery .= '&search_name=' . $search;
        }

        $doctorTypeQuery = "";
        if (!empty($doctor_type)) {
            $doctorTypeQuery .= '&doctor_type=' . $doctor_type;
        }

        $cityIdQuery = "";
        if (!empty($city_id)) {
            $searchQuery .= '&city_id=' . $city_id;
        }

        $districtIdQuery = "";
        if (!empty($district_id)) {
            $districtIdQuery .= '&district_id=' . $district_id;
        }

        $divisionIdQuery = "";
        if (!empty($division_id)) {
            $divisionIdQuery .= '&division_id=' . $division_id;
        }

        $locationNameQuery = "";
        if (!empty($location)) {
            $locationNameQuery .= '&location=' . $location;
        }

        $showNameQuery = "";
        if (!empty($pageShowType)) {
            $showNameQuery .= '&show=' . $pageShowType;
        }

        // dd(route('user.search', $searchQuery . $doctorTypeQuery));
        //res: http: //127.0.0.1:8000/search?q=aoeae&doctor_type=one
        return redirect()->route(
            'user.search',
            $searchQuery .
            $doctorTypeQuery .
            $cityIdQuery .
            $districtIdQuery .
            $divisionIdQuery .
            $locationNameQuery .
            $pageQuery .
            $showNameQuery .
            $hospitalPaginationQuery
        );
    }
}
