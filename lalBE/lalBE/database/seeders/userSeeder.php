<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Moeen',
            'email' => 'moeensedaghaty86@gmail.com',
            'password' => bcrypt('Moeen576786'),
            'isAdmin' => 1,
        ]);
        User::create([
            'name' => 'NoorAhmad Jorjani',
            'email' => 'noorahmadjorjani@gmail.com',
            'password' => bcrypt('Erfan1386#4'),
            'isAdmin' => 1,
        ]);
    }
}
