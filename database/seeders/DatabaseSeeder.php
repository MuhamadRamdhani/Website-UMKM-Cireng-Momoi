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
            'name' => 'Admin',
            'email' => 'admin@cireng.com',
            'password' => Hash::make('admin1234'), 
            'role' => 'admin',
        ]);
    }
}
