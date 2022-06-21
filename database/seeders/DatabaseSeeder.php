<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(UserGroupSeeder::class);
        //
        $this->call(AlbumsSeeder::class);
        $this->call(AlbumSeeder::class);

    }
}
