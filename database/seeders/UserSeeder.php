<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::ulid(),
            'name' => 'Admin',
            'email' => 'admin@ifump.net',
            'password' => Hash::make('password'),
            'membership_date' => '2012-12-12'
        ]);
    }
}