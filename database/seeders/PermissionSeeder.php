<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('permission')->insert(
            [
                [
                    'permission_name' => '公开',
                    'description' => '所有人都可以访问',
                    'is_usable' => true, // password
                    'sorting_order' => 1
                ],
                [
                    'permission_name' => '家人',
                    'description' => '家人权限访问',
                    'is_usable' => true, // password
                    'sorting_order' => 2
                ],
                [
                    'permission_name' => '朋友',
                    'description' => '朋友权限访问',
                    'is_usable' => true, // password
                    'sorting_order' => 3
                ],
            ]
        );
    }
}
