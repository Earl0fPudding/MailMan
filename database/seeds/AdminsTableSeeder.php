<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin user
        $admin = new Admin();
	$admin->username = "admin";
	$admin->password = Hash::make('admin');
	$admin->save();
    }
}
