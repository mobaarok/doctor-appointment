<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = new Admin;
       $admin->name  = 'Mobarok';
       $admin->email = 'admin@mail.com';
       $admin->password = bcrypt('admin');
       $admin->save();
    }
}
