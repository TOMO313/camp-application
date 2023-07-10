<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'camp'=>'ならここの里キャンプ場',
            'body'=>'静岡県掛川市にあり、清流と緑に囲まれた山あいのキャンプ場です！特徴は源泉100%の天然温泉「ならここの湯」があり、肌がつるつるになる泉質が自慢です！レンタル用品が充実しているので手ぶらでもキャンプをすることができます！',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'season_id'=>'1',
            'user_id'=>'1',
            
        ]);
    }
}
