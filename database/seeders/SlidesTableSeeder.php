<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slide;

class SlidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slide::create([
            'title' => 'Building Bridges #Initiative',
            'tagline' => 'Building Bridges to a United Kenya from a nation of blodd ties to a nation of ideal.',
            'photo' => '1642879018.jpeg'
        ]);

        Slide::create([
            'title' => 'The mother of democracy #MAMANIMMOJA',
            'tagline' => 'She is credited with having caregeously fought the increase of democractic spaces in Mumias.',
            'photo' => '1642879083.png'
        ]);

        Slide::create([
            'title' => 'Education is key to our future',
            'tagline' => 'Education is the passport to the future, for tommorrow belongs to those who prepare for it today.',
            'photo' => '1642879083.png'
        ]);
    }
}
