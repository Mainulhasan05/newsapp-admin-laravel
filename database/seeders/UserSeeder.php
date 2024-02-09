<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Md. Mainul Hasan',
            'email' => 'mdrifatbd5@gmail.com',
            'password' => Hash::make('123456'),
            'role'=> 1
        ]);

        User::create([
            'name' => 'Md. Kawser Ahmed',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role'=> 1
        ]);
    }
}
