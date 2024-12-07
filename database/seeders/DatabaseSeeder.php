<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Naufal Harits Prasetia',
            'username' => 'naufalharits',
            'email' => 'naufal@gmail.com',
            'password' => bcrypt('bismillah'),
        ]);
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('bismillah'),
            'is_admin' => true,
        ]);
        Exam::create([
            'title' => 'Practice 1',
            'description' => ''
        ]);
        Exam::create([
            'title' => 'Practice 2',
            'description' => ''
        ]);
    }
}