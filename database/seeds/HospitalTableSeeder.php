<?php

use App\Model\Hospital;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HospitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $admin = new Hospital;
        $admin->hospital_name = 'Demo Hospital Ltd.';
        $admin->email = 'hospital@mail.com';
        $admin->password = bcrypt('admin');
        $admin->is_activated = 1;
        $admin->email_verification_token = Str::random(30);
        $admin->division_id = 1;
        $admin->district_id = 1;
        $admin->upazila_id = 1;
        $admin->save();

        for ($i = 1; $i < 20; $i++) {
            Hospital::create([
                'hospital_name' => $faker->company,
                'mobile_phone' => '8801635449686',
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('admin'),
                'is_activated' => 1,
                'email_verification_token' => Str::random(30),

                'username' => $faker->userName,
                'division_id' => 2,
                'district_id' => 20,
                'upazila_id' => rand(1, 4),
                'address' => $faker->streetAddress,
                

                'mobile_phone' => $faker->unique()->phoneNumber,
                'telephone' => '+880768534',
                'hospital_open_time' => $faker->time,
                'hospital_closing_time' => $faker->time,
            ]);
        }

    }
}
