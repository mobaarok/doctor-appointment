<?php

use Illuminate\Database\Seeder;

class UpazilaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('upazilas')->insert([

            //Start Feni District's Upazilas
            [ 'upazila_name'=>'Feni Sadar', 'district_id'=>'20', 'division_id'=>'2'],
            [ 'upazila_name'=>'Chagalnaiya', 'district_id'=>'20', 'division_id'=>'2'],
            [ 'upazila_name'=>'Parshuram', 'district_id'=>'20', 'division_id'=>'2'],
            [ 'upazila_name'=>'Sonagazi', 'district_id'=>'20', 'division_id'=>'2'],
            [ 'upazila_name'=>'Dagunbhuiyan', 'district_id'=>'20', 'division_id'=>'2'],
            [ 'upazila_name'=>'Fulgazi', 'district_id'=>'20', 'division_id'=>'2'],
        ]);

    }
}
