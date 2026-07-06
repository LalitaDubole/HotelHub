<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@hotelhub.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Sample user
        User::create([
            'name'     => 'Lalita',
            'email'    => 'lalita123@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);

        // Rooms seeder
        $this->call(RoomSeeder::class);
    }
}