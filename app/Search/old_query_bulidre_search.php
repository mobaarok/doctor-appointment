<?php

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
            $doctor->whereHas("expertises", function (Builder $query) use ($filters) {
                $query->where('expertise_id', '=', $filters->input('doctor_type'));
            })->with([
                'expertises',
                'hospitals'
            ]);
        }

        if ($filters->has('division_id')) {
            $doctor->whereHas('hospitals', function (Builder $query) use ($filters) {
                $query->where('division_id', '=', $filters->input('division_id'));
            })->with([
                'expertises',
                'hospitals'
            ]);
        }

        if ($filters->has('district_id')) {
            $doctor->whereHas('hospitals', function (Builder $query) use ($filters) {
                $query->where('district_id', '=', $filters->input('district_id'));
            })->with([
                'expertises',
                'hospitals'
            ]);
        }

        if ($filters->has('city_id')) {
            $doctor->whereHas('hospitals', function (Builder $query) use ($filters) {
                $query->where('upazila_id', '=', $filters->input('city_id'));
            })->with([
                'expertises',
                'hospitals'
            ]);
        }
        // we can add new filter just cheecking them thay exist in request,
        return $doctor->paginate(3);
    }
}
