<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_group')->insert(
            [
                [
                    'group_name' => '公开',
                    'description' => '所有人都可以访问',
                    'is_usable' => true, // password
                    'sorting_order' => 1
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
