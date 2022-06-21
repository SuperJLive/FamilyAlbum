<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('album')->insert([
            [
                'title' => '出生',
                'albums_id' => '1',
                'permission' => '0',
                'tags' => 'tag1,tag2',
                'min_take_stamp' => '2019-05-19',
                'max_take_stamp' => '2019-05-21',
                'downloadable' => '0',
                'shareable' => '0',
                'user_id' => '1',
                'password' => null,
                'description' => '相册概述'
            ],
            [
                'title' => '游戏',
                'albums_id' => '1',
                'permission' => '0',
                'tags' => 'tag1,tag2',
                'min_take_stamp' => '2019-06-19',
                'max_take_stamp' => '2019-06-21',
                'downloadable' => '0',
                'shareable' => '0',
                'user_id' => '1',
                'password' => null,
                'description' => '相册概述'
            ],
            [
                'title' => '游玩',
                'albums_id' => '2',
                'permission' => '0',
                'tags' => 'tag1,tag2',
                'min_take_stamp' => '2019-08-19',
                'max_take_stamp' => '2019-12-21',
                'downloadable' => '0',
                'shareable' => '0',
                'user_id' => '1',
                'password' => null,
                'description' => '相册概述'
            ]
        ]);
    }
}
