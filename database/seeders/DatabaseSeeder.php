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
        $this->call(AboutTableSeeder::class);
        $this->call(PledgeTableSeeder::class);
        $this->call(IssuesTableSeeder::class);
        $this->call(MoreAboutTableSeeder::class);
        $this->call(PhotoTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
