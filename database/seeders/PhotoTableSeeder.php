<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Photo::create([
            'category' => 'Meeting',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642881147.jpeg'
        ]);

        Photo::create([
            'category' => 'Politics',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642881183.jpeg'
        ]);

        Photo::create([
            'category' => 'Agenda',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642881230.jpeg'
        ]);

        Photo::create([
            'category' => 'Event',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642881281.jpeg'
        ]);

        Photo::create([
            'category' => 'Politics',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642881372.jpeg	'
        ]);

        Photo::create([
            'category' => 'Meeting',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642881414.jpeg'
        ]);
    }
}
