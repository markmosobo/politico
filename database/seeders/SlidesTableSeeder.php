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
            'title' => 'Better Leadership',
            'tagline' => ' Let us unite our people, develop our constituency, inculcate values of competence, integrity, moral ethics and one that embraces education.',
            'photo' => '1643274827.jpeg'
        ]);

        Slide::create([
            'title' => 'Mama Power!',
            'tagline' => 'I intend to lead by being of service, listening to the plight of my people, and fostering collaboration in matters that affect us all.',
            'photo' => 'speak.jpg'
        ]);

        Slide::create([
            'title' => 'Education is key to our future',
            'tagline' => 'Education is the passport to the future, for tommorrow belongs to those who prepare for it today.',
            'photo' => '1642881147.jpeg'
        ]);
    }
}
