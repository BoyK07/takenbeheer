<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'BoyK07',
            'email' => 'admin@sadcat.space',
            'password' => Hash::make('pass'),
        ]);

        User::factory(10)->create();
    }
}
