<?php

use Illuminate\Database\Seeder;
use App\Model\DoctorExpertise;

class DoctorExpertisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i = 1; $i < 20; $i++) {
            DoctorExpertise::create([
                'doctor_id' => rand(1, 19),
                'expertise_id' => rand(1, 6)
            ]);
        }
    }
}
