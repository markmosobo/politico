<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' =>  Hash::make('123456')            
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'role' => 'user',
            'password' =>  Hash::make('123456')            
        ]);
    }
}
