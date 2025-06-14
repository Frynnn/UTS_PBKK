<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'id' => Str::ulid(),
            'title' => 'Laravel untuk Pemula',
            'isbn' => '978-602-1234-567-1',
            'publisher' => 'Informatika Press',
            'year_published' => '2022',
            'stock' => 10,
        ]);
    }
}
