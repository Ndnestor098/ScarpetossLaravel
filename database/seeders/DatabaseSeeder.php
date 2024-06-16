<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nestor Daniel',
            'email' => 'nd10salom@gmail.com',
            'password' => Hash::make('cronos'),
            'is_admin' => 1,
        ]);

        User::factory(1000)->create();

    }
}
