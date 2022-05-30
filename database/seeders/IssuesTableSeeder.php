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
            'name' => 'Youth Empowerment',
            'details' => 'Encourage the youth through mentorship to start their own businesses, start ups thus building a
            sustainable constituency.',
            'photo' => '1642880277.jpeg'
        ]);

        Issue::create([
            'name' => 'Business Community',
            'details' => 'Through provision of grants to start ups and businesses, I can address the issue of poverty
            in our constituency.',
            'photo' => '1642880195.jpg'
        ]);

        Issue::create([
            'name' => 'Early child marriages',
            'details' => 'I aspire to help in fighting teenage pregancies and teenage mothers have been on the rise in the constituency.',
            'photo' => '1642880276.jpeg'
        ]);

        Issue::create([
            'name' => 'Health Care',
            'details' => 'Working with community health volunteers to make sure that preventive health care is well managed.',
            'photo' => '1642880196.jpeg'
        ]);

    }
}
