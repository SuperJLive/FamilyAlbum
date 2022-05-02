<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0;$i<75;$i++)
        {
            DB::table('user')->insert([
            'openid' => Str::random(64),
            'nick_name' => Str::random(8),
            'password' => '123456', // password
            'first_login_time' => date('Y-m-d H:i:s'),
            'last_login_time' => date('Y-m-d H:i:s')
            ]);
        }

        // User::factory()
        // ->count(50)
        // ->create();
    }
}
