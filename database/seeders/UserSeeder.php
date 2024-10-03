<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nestor Daniel',
            'email' => 'nd10salom@gmail.com',
            'password' => Hash::make('cronos098'),
            'is_admin' => 1,
        ]);

        User::factory(1000)->create();
    }
}
