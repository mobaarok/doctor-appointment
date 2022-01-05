<?php

namespace App\Repositories;

use App\Model\Division;
use Illuminate\Support\Facades\DB;

class LocationRepository
{
    public function getDistirctByDivisionId($division_id)
    {
        return DB::table('districts')
            ->where('division_id', $division_id)
            ->get();
    }

    public function getUpazilaByDistrictId($district_id)
    {
        return DB::table('upazilas')
            ->where('district_id', $district_id)
            ->get();
    }
    public function getAllDivision()
    {
        return Division::get();
    }
}
