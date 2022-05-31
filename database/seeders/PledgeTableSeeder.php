<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pledge;

class PledgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pledge::create([
            'pledge' => 'I also seek to improve existing businesses and encourage mentorship of the youth, thus building a sustainable community;
            one that does not depend on hand-outs.',
            'details' => 'In order to improve sustainability to Mumias constituents, I plan to boost existing businesses and youth
            empowerment. Empowering communities through trainings and enabling them to have their own businesses through provision of 
            grants.',
            'photo' => 'MP project.png',   
            'slug' => 'https://www.youtube.com/watch?v=0BHKw0nyIiA&ab_channel=LUHYAHERITAGE%26CULTURE'    
        ]);        
    }
}
