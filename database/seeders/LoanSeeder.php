<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil salah satu user dan book dari database
        $user = User::first(); // ambil user pertama
        $book = Book::first(); // ambil book pertama

        // Cek jika datanya tersedia
        if ($user && $book) {
            Loan::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
            ]);
        }
    }
}
