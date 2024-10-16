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
            'username' => 'naufalharisprasetia',
            'email' => 'naufal@unida.gontor.ac.id',
            'password' => bcrypt('bismillah'),
        ]);
        Exam::create([
            'title' => 'practice1',
            'description' => 'Exam For Beginner'
        ]);
    }
}
