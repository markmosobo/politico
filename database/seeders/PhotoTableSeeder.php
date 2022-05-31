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
            'photo' => 'gallery1.jpg'
        ]);

        Photo::create([
            'category' => 'Politics',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => 'gallery3.jpg'
        ]);

        Photo::create([
            'category' => 'Agenda',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => 'gallery6.jpg'
        ]);

        Photo::create([
            'category' => 'Event',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => 'gallery2.jpg'
        ]);

        Photo::create([
            'category' => 'Politics',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => 'gallery5.jpg	'
        ]);

        Photo::create([
            'category' => 'Politics',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => 'gallery7.jpg	'
        ]);

        Photo::create([
            'category' => 'Meeting',
            'description' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => 'gallery4.jpg'
        ]);
    }
}
