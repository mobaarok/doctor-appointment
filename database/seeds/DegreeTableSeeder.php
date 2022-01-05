<?php

use Illuminate\Database\Seeder;
use App\Model\DoctorDegree;

class DegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degree = array('mbbs', 'fcs', 'mms', 'lls', 'bcs', 'kks');
        foreach($degree as $item) {
            DoctorDegree::create([
                'degree_short_name' => $item,
                'degree'  => $item,
            ]);
        }


    }
}
