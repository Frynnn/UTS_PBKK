<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Book extends Model
{

    use HasUlids;
    
    protected $fillable =[
    'title',
    'isbn',
    'publisher',
    'year_published',
    'stock'
    ];

    protected $table = 'books';

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'isbn' => 'string',
            'publisher' => 'string',
            'year_published' => 'string',
            'stock' => 'integer',
        ];
    }
}