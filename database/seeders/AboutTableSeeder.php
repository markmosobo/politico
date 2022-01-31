<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'mission' => 'My goal is to help alleviate poverty within the constituents
                         and promote accountable and inclusive leadership.To address poverty, I intend to empower communities
                         through trainings that enable them have start ups through grants.',
            'introduction' => 'Hon. Jackline Mwakha Okanya seeks to be the MP for Mumias West Constituency and is currently the
                                nominated MCA of Kakamega County Assembly courtesy of a nomination by Amani National Congress (ANC).',
            'media' => 'https://www.youtube.com/watch?v=0BHKw0nyIiA&ab_channel=LUHYAHERITAGE%26CULTURE'    
        ]);        
    }
}
