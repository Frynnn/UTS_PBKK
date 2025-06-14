<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Loan extends Model
{

    use HasUlids;
    
    protected $fillable =[
    'loan_id',
    'user_id',
    'book_id'
    ];

    protected $table = 'loans';

    protected function casts(): array
    {
        return [
            'loan_id' => 'string',
            'user_id' => 'string',
            'book_id' => 'string'
        ];
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function book()
    {
        return $this->belongsTo(Book::class);
    }
}