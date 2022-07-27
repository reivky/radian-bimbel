<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Registrant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Teacher::factory(100)->create();
        Student::factory(100)->create();
        Registrant::factory(100)->create();
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@radianbimbel.com',
            'email_verified_at' => now(),
            'password' => bcrypt('radian11'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
