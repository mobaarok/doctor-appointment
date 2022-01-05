<?php

use Illuminate\Database\Seeder;
use App\Model\DoctorInstitute;

class InstituteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institute = array('cmc', 'dmc', 'ctg', 'feni', 'butc', 'cct');
        foreach($institute as $item) {
           DoctorInstitute::create([
               'institute_short_name' => $item,
                'institute' => $item,
           ]);
        }
    }
}
