<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Tomoya',
            'email' => 'AW4b13vd@icloud.com',
            'password' => Hash::make(config('servises.User.Password')),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
