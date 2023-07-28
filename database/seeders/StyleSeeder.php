<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('styles')->insert([
            'name' => '家族',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
        DB::table('styles')->insert([
            'name' => 'ソロ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
        DB::table('styles')->insert([
            'name' => '手ぶら',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
       
    }
}
