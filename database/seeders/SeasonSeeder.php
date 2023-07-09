<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->insert([
            'season' => '春',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
        DB::table('seasons')->insert([
            'season' => '夏',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
        DB::table('seasons')->insert([
            'season' => '秋',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
        DB::table('seasons')->insert([
            'season' => '冬',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
    }
}
