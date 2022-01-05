<?php

namespace App\Search;

use App\Model\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchDoctor
{
    public static function apply(Request $filters)
    {
        $queryBuilder = (new Doctor)->newQuery()->with([
            'hospitals',
            'expertises',
        ]);
        $query = static::applyFiltersToQuery($filters, $queryBuilder);
        return static::getResult($query);
    }

    private static function applyFiltersToQuery(Request $filters, Builder $queryBuilder)
    {
        foreach ($filters->all() as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);
            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($queryBuilder, $value);
            }
        }
        return $query ?? '';
    }

    private static function createFilterDecorator($filterName)
    {
        $decorator =
        __NAMESPACE__ . '\\DoctorFilters\\' .
        str_replace(' ', '', ucwords(
            str_replace('_', ' ', $filterName)
        )); //do this: city_id to "App\Search\Filters\CityId;
        return $decorator;
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private static function getResult($query)
    {
        if ($query) {
            return $query->paginate(8);
        }
        return;
    }
}
