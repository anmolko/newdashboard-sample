<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin6',
            'email' => 'admin6@gmail.com',
            'gender' => 'male',
            'user_type' => 'admin',
            'status' => 1,
            'password' => Hash::make('admin6'),
        ]);
    }
}
