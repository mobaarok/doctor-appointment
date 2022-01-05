<?php

use App\Model\Doctor;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 1; $i < 20; $i++) {
            Doctor::create([
                'doctor_name' => $faker->name,
            ]);
        }
    }
}
