<?php

use Illuminate\Database\Seeder;
use App\Model\DoctorQualification;

class DoctorQualificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i= 1; $i < 40; $i++) {
            DoctorQualification::create([
                'doctor_id'  => rand(1, 18),
                'degree_id'  => rand(1, 6),
                'institute_id'  => rand(1, 6),
            ]);
        }
    }
}
