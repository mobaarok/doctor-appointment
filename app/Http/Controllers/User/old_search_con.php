<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Doctor;
use App\Model\Expertise;
use App\Model\Hospital;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $search = $request->q;
        $doctor_type = $request->doctor_type;
        $city_id = $request->city_id;
        $exertises = Expertise::get();
        $doctors = '';

        if (!empty($search) && empty($doctor_type)) {
            $doctors = Doctor::with([
                'expertises',
                'hospitals'
            ])->where("doctor_name", "like", "%{$search}%")
                ->paginate(10);
        } elseif (empty($search) && !empty($doctor_type)) {
            $doctors = Doctor::with([
                'expertises',
                'hospitals'
            ])->whereHas('expertises', function (Builder $query) use ($doctor_type) {
                $query->where('expertise_id', '=', $doctor_type);
            })->paginate(10);
        } elseif (!empty($search) && !empty($doctor_type)) {
            $doctors = Doctor::with([
                'expertises',
                'hospitals'
            ])->where('doctor_name', "like", "%{$search}%")
                ->whereHas('expertises', function (Builder $query) use ($doctor_type) {
                    $query->where('expertise_id', '=', $doctor_type);
                })->paginate(10);
        }

        return view('user.search', [
            'doctors' => $doctors,
            'search' => $search,
            'expertises' => $exertises,
            'doctor_type' => $doctor_type,
        ]);
    }

    public function filter(Request $request)
    {
        //dd($request->all());
        //Request data field
        //   "search" => null
        //   "doctor_type" => null
        $search = $request->search;
        $doctor_type = $request->doctor_type;
        $searchQuery = "";
        if (!empty($search)) {
            $searchQuery .= '&q=' . $search;
        }

        $doctorTypeQuery = "";
        if (!empty($doctor_type)) {
            $doctorTypeQuery .= '&doctor_type=' . $doctor_type;
        }
        // dd(route('user.search', $searchQuery . $doctorTypeQuery));
        //res: http: //127.0.0.1:8000/search?q=aoeae&doctor_type=one
        return redirect()->route('user.search', $searchQuery . $doctorTypeQuery);
    }
}


// using bulider not model


namespace App\Search;

use App\Model\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Search
{
    public static function apply(Request $filters)
    {
        $doctor = (new Doctor)->newQuery();
        
        // Search for a user based on their name.
        if ($filters->has('q')) {
            $doctor->where("doctor_name", "like",  "%{$filters->input('q')}%")->with([
                'expertises',
                'hospitals',
            ]);
        }
        if ($filters->has('doctor_type')) {
            $doctor->whereHas("expertises", function (Builder $query) use($filters) {
                $query->where('expertise_id', '=', $filters->input('doctor_type')); 
            })->with([
                'expertises',
                'hospitals'
            ]);
        }

        // we can add new filter just cheecking them thay exist in request,
        return $doctor->paginate(3);
    }

}