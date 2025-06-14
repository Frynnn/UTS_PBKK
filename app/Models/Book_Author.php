<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Book_Author extends Model
{

    use HasUlids;
    
    protected $fillable =[
    'book_author_id',
    'book_id',
    'author_id'
    ];

    protected $table = 'books_authors';

    protected function casts(): array
    {
        return [
            'book_author_id' => 'string',
            'book_id' => 'string',
            'author_id' => 'string'
        ];
    }

        public function author()
    {
        return $this->belongsTo(Author::class);
    }

        public function book()
    {
        return $this->belongsTo(Book::class);
    }
}