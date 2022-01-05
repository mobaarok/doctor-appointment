<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert([

//Start Dhaka Division
           [ 'district_name'=>'Dhaka',      'division_id'=>'1'],
           [ 'district_name'=>'Faridpur',   'division_id'=>'1'],
           ['district_name'=>'Gopalganj',  'division_id'=>'1'],
           ['district_name'=>'Kishoregonj','division_id'=>'1'],
           ['district_name'=>'Gazipur',    'division_id'=>'1'],
           ['district_name'=>'Madaripur',  'division_id'=>'1'],
           ['district_name'=>'Manikganj',  'division_id'=>'1'],
           ['district_name'=>'Munshiganj', 'division_id'=>'1'],
           ['district_name'=>'Narayanganj','division_id'=>'1'],
           [ 'district_name'=>'Narsingdi', 'division_id'=>'1'],
           [ 'district_name'=>'Rajbari',   'division_id'=>'1'],
           [ 'district_name'=>'Shariatpur','division_id'=>'1'],
           [ 'district_name'=>'Tangail',   'division_id'=>'1'],
//Start Chittagong Division
           [ 'district_name'=>'Chittagong', 'division_id'=>'2'],
           [ 'district_name'=>'Brahmanbaria', 'division_id'=>'2'],
           [ 'district_name'=>'Chandpur', 'division_id'=>'2'],
           [ 'district_name'=>' Bandarban', 'division_id'=>'2'],
           [ 'district_name'=>'Comilla', 'division_id'=>'2'],
           [ 'district_name'=>'Coxs Bazar', 'division_id'=>'2'],
           [ 'district_name'=>'Feni', 'division_id'=>'2'],
           [ 'district_name'=>'Khagrachhari', 'division_id'=>'2'],
           [ 'district_name'=>'Lakshmipur', 'division_id'=>'2'],
           [ 'district_name'=>'Noakhali', 'division_id'=>'2'],
           [ 'district_name'=>'Rangamati', 'division_id'=>'2'],
// Start  Khulna Division
           [ 'district_name'=>'Khulna', 'division_id'=>'3'],
           [ 'district_name'=>'Chuadanga', 'division_id'=>'3'],
           [ 'district_name'=>'Jessore', 'division_id'=>'3'],
           [ 'district_name'=>'Jhenaidah', 'division_id'=>'3'],
           [ 'district_name'=>' Bagerhat', 'division_id'=>'3'],
           [ 'district_name'=>'Khustia', 'division_id'=>'3'],
           [ 'district_name'=>'Magura', 'division_id'=>'3'],
           [ 'district_name'=>'Meherpur', 'division_id'=>'3'],
           [ 'district_name'=>'Narail', 'division_id'=>'3'],
           [ 'district_name'=>'Satkhira', 'division_id'=>'3'],
//Start Barishal Division
           [ 'district_name'=>'Barisal', 'division_id'=>'4'],
           [ 'district_name'=>' Barguna', 'division_id'=>'4'],
           [ 'district_name'=>'Bhola', 'division_id'=>'4'],
           [ 'district_name'=>'Jhalokati', 'division_id'=>'4'],
           [ 'district_name'=>'Patuakhali', 'division_id'=>'4'],
           [ 'district_name'=>'Pirojpur', 'division_id'=>'4'],
//Start Rajshahi Division
           [ 'district_name'=>' Rajshahi', 'division_id'=>'5'],
           [ 'district_name'=>'Joypurhat', 'division_id'=>'5'],
           [ 'district_name'=>'Naogaon', 'division_id'=>'5'],
           [ 'district_name'=>'Natore', 'division_id'=>'5'],
           [ 'district_name'=>'Chapai nawabganj', 'division_id'=>'5'],
           [ 'district_name'=>'Pabna', 'division_id'=>'5'],
           [ 'district_name'=>'Bogra', 'division_id'=>'5'],
           [ 'district_name'=>'Sirajganj', 'division_id'=>'5'],
//Start Rangpur Division
           [ 'district_name'=>' Rangpur', 'division_id'=>'6'],
           [ 'district_name'=>'Gaibandha', 'division_id'=>'6'],
           [ 'district_name'=>'Kurigram', 'division_id'=>'6'],
           [ 'district_name'=>'Lalmonirhat', 'division_id'=>'6'],
           [ 'district_name'=>'Nilphamari', 'division_id'=>'6'],
           [ 'district_name'=>'Panchagarh', 'division_id'=>'6'],
           [ 'district_name'=>'Dinajpur', 'division_id'=>'6'],
           [ 'district_name'=>'Thakurgaon', 'division_id'=>'6'],
//Start sylhet Division
           [ 'district_name'=>' Sylhet', 'division_id'=>'7'],
           [ 'district_name'=>'Molvibazar', 'division_id'=>'7'],
           [ 'district_name'=>'Sunamganj', 'division_id'=>'7'],
           [ 'district_name'=>'Habiganj', 'division_id'=>'7'],
//Start Mymensing Division
           [ 'district_name'=>' Mymensingh', 'division_id'=>'8'],
           [ 'district_name'=>'Jamalpur', 'division_id'=>'8'],
           [ 'district_name'=>'Netrokona', 'division_id'=>'8'],
           [ 'district_name'=>'Sherpur', 'division_id'=>'8']

        ]);





    }
}
