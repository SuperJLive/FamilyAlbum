<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        DB::table('album_owner')->insert(
            [
                [
                    'album_name' => '宝宝相册',
                    'owner_id'=>0,
                    'permission' => 1,
                    'is_usable' => true,
                    'is_visible' => true,
                    'downloadable' => false,
                    'shareable' => false,
                    'password' => null,
                    'birthday'=>'2019-01-01',
                    'max_show_age'=>18,
                    'description' => '妙妙的美妙时光',
                    'sorting_order' => 1,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ],
                [
                    'album_name' => '宝妈相册',
                    'owner_id'=>0,
                    'permission' => 2,
                    'is_usable' => true,
                    'is_visible' => true,
                    'downloadable' => true,
                    'shareable' => true,
                    'password' => null,
                    'birthday'=>null,
                    'max_show_age'=>0,
                    'description' => '小仙女打拳',
                    'sorting_order' => 2,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ],
                [
                    'album_name' => '宝爸相册',
                    'owner_id'=>0,
                    'permission' => 1,
                    'is_usable' => true,
                    'is_visible' => true,
                    'downloadable' => true,
                    'shareable' => true,
                    'password' => null,
                    'birthday'=>null,
                    'max_show_age'=>0,
                    'description' => '悲惨世界',
                    'sorting_order' => 3,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ],
            ]
        );
    }

}
