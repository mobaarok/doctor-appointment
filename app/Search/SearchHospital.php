<?php

namespace App\Search;

use App\Model\Hospital;
use Illuminate\Database\Eloquent\Builder;

class SearchHospital
{
    public static function apply($filters)
    {
        $query = (new Hospital())->newQuery();
        $hospital = static::applyFiltersToQuery($filters, $query);
        return static::getResult($filters, $hospital);
    }

    private static function getResult($filters, $hospital)
    {
        if ($filters->hasAny([
            'search_name',
            'city_id',
            'district_id',
            'division_id',
            'doctor_type',
        ])) {
            return $hospital->paginate(3);
        }
    }

    protected static function applyFiltersToQuery($filters, $query)
    {
        if ($filters->has('search_name')) {
            $query->where("hospital_name", "like", "%{$filters->input('search_name')}%");
        }
        if ($filters->has('city_id')) {
            $query->where('upazila_id', '=', $filters->input('city_id'));
        }
        if ($filters->has('district_id')) {
            $query->where('district_id', '=', $filters->input('district_id'));
        }
        if ($filters->has('division_id')) {
            $query->where('division_id', '=', $filters->input('division_id'));
        }
        if ($filters->has('doctor_type')) {
            $query->whereHas('doctors', function (Builder $builder) use ($filters) {
                // $builder->where('expertise_id', '=', $filters->input('doctor_type'));
                $builder->whereHas('expertises', function (Builder $buli) use ($filters) {
                     $buli->where('expertise_id', '=', $filters->input('doctor_type')); 
                });
            });
        }
        return $query;
    }
}
