<?php

namespace App\Search\DoctorFilters;


use Illuminate\Database\Eloquent\Builder;

class CityId implements DoctorFilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereHas('hospitals', function (Builder $query) use($value) {
                $query->where('upazila_id', '=', $value);
        });
    }
}