<?php

namespace Database\Seeders;

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
                    'description' => '属于宝宝的相册',
                    'sorting_order' => 1
                ],
                [
                    'album_name' => '宝妈相册',
                    'owner_id'=>0,
                    
                    'permission' => 1,
                    'is_usable' => true,
                    'is_visible' => true,
                    'downloadable' => false,
                    'shareable' => false,
                    'password' => null,
                    'birthday'=>null,
                    'max_show_age'=>0,
                    'description' => '属于宝妈的相册',
                    'sorting_order' => 2
                ],
            ]
        );
    }

}
