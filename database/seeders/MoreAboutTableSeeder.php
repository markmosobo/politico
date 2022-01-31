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
            'attribute' => 'Reliable',
            'description' => 'Her service as Kakamega County Branch secretary under ANC 
             has been a success.This led to her nomination to the county aseembly. This happened despite
             being short-changed in the ODM primaries.',
            'photo' => '1642879083.png'
        ]);

        MoreAbout::create([
            'attribute' => 'Transparent',
            'description' => 'We have a leadership that does not operate with manifestos.
             We want the electorate to be included in what I am doing and work with community
              health volunteers to make sure preventive health care is well managed.',
            'photo' => '1642879083.png'
        ]);

        MoreAbout::create([
            'attribute' => 'Competent',
            'description' => 'She has a wide experience in the finance sector and public relations given her tenure at Faulu Kenya and Kenya Women Finance
            Trust where she discharged her duties as a financial advisor and asessed businesses that can be financed.',
            'photo' => '1642879083.png'
        ]);
    }
}
