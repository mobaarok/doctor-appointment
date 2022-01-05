<?php

use App\Model\Expertise;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(DivisionTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(UpazilaTableSeeder::class);

        $this->call(AdminTableSeeder::class);
        $this->call(HospitalTableSeeder::class);
        $this->call(DoctorTableSeeder::class);

        $this->call(DoctorAssignTableSeeder::class);

        $this->call(ExpertiseTableSeeder::class);
        $this->call(DoctorExpertisesTableSeeder::class);
        
        $this->call(DegreeTableSeeder::class);
        $this->call(InstituteTableSeeder::class);
        $this->call(DoctorQualificationsTableSeeder::class);
    }
}
