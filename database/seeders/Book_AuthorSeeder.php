<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Book_Author;
use App\Models\Book;
use App\Models\Author;

class Book_AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil satu book dan author pertama dari database
        $book = Book::first();
        $author = Author::first();

        if ($book && $author) {
            Book_Author::create([
                'book_id' => $book->id,
                'author_id' => $author->id,
            ]);
    }
    }
}