<?php

use Illuminate\Database\Seeder;
use App\Model\Expertise;

class ExpertiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummyExpertises = [
            'Gyne Specialist',
            'Medicine Specialist',
            'Skin & Sexual Department',
             'Kidney', 
             'Medicine',  
             'Diabetes Specialist',
        ];

        foreach($dummyExpertises as $item) {
            Expertise::create([
                'expertise_name' => $item,
            ]);
        }
    }
}
