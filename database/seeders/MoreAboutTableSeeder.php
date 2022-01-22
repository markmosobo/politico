<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoreAbout;

class MoreAboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoreAbout::create([
            'attribute' => 'Mother of Democracy',
            'description' => 'Jack is the founder of Mumias Dairy Farming, the first of its kind in Mumias sunb county.',
            'photo' => '1642879083.png'
        ]);

        MoreAbout::create([
            'attribute' => 'True Leader',
            'description' => 'There is no denying that the leadership qualities exhibited during her tenure as Women Rep are central to public acclaim.',
            'photo' => '1642879018.jpeg'
        ]);

        MoreAbout::create([
            'attribute' => 'Committed & Passionate',
            'description' => 'Her warmth to children can be shown with her support for various Childrens Homes',
            'photo' => '1642879083.png'
        ]);
    }
}
