<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorAssignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 90; $i++) {
           DB::table('doctors_in_hospitals')->insert([
                'hospital_id' => random_int(1, 18),
                'doctor_id'  => random_int(1, 18),
            ]);
        }
    }
}
