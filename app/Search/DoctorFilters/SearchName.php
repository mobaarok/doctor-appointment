<?php

namespace App\Search\DoctorFilters;


use Illuminate\Database\Eloquent\Builder;

//laravel follow PSR-4, thats why we don't need 
//to include 'use App\Search\Filters\FilterInterface;' namespace;

class SearchName implements DoctorFilterInterface
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
        return $builder->where("doctor_name", "like",  "%{$value}%");
    }
}
