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
                    'description' => '属于宝宝的相册',
                    'permission' => 1,
                    'is_usable' => true,
                    'is_visible' => true,
                    'downloadable' => false,
                    'shareable' => false,
                    'password' => null,
                    'description' => '属于宝宝的相册',
                    'sorting_order' => 2
                ],
                [
                    'group_name' => '家人',
                    'description' => '家人权限访问',
                    'is_usable' => true, // password
                    'sorting_order' => 2
                ],
                [
                    'group_name' => '朋友',
                    'description' => '朋友权限访问',
                    'is_usable' => true, // password
                    'sorting_order' => 3
                ],
                [
                    'group_name' => '同事',
                    'description' => '同事权限访问',
                    'is_usable' => true, // password
                    'sorting_order' => 4
                ],
            ]
        );
    }

}
