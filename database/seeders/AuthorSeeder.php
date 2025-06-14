<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'id' => Str::ulid(),
            'name' => 'Haruki Murakami',
            'nationality' => 'Japan',
            'birthdate' => '1949-01-12',
        ]);
    }
}
