<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issue::create([
            'name' => 'Comprehensive Youth Program',
            'details' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642880195.jpeg'
        ]);

        Issue::create([
            'name' => 'Economic Opportunity',
            'details' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642880276.jpeg'
        ]);

        Issue::create([
            'name' => 'Health Care',
            'details' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642880195.jpeg'
        ]);

        Issue::create([
            'name' => 'Climate Change',
            'details' => 'Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.',
            'photo' => '1642880374.jpeg'
        ]);
    }
}
