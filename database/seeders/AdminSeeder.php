<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'last_name' => "User",
                'mobile' => 919999999989,
                'state' => "Maharashtra",
                'city' => "Mumbai",
                'pincode' => 200002,
                'password' => bcrypt('Admin@12345'),
                'is_admin' => true
            ]
        ]);
    }
}
