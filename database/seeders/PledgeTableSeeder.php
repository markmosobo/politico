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
            'pledge' => 'I aspire to provide quality leadership and utmost integrity.
             I continuously strives to elevate Kenyan’s faith, and to fill our country
              Kenya with justice.',
            'details' => 'Integer rutrum ligula eu dignissim laoreet. Pellentesque
             venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus
              molestie. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
               Sed vitae rutrum neque. Ut id erat sit amet libero bibendum aliquam. Donec ac egestas libero,
                eu bibendum risus. Phasellus et congue justo.',
            'photo' => 'slide-4.png',   
            'slug' => 'https://www.youtube.com/watch?v=0BHKw0nyIiA&ab_channel=LUHYAHERITAGE%26CULTURE'    
        ]);        
    }
}
