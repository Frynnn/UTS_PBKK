<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Author extends Model
{

    use HasUlids;
    
    protected $fillable =[
    'name',
    'nationality',
    'birthdate'
    ];

    protected $table = 'authors';

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'nationality' => 'string',
            'birthdate' => 'date',
        ];
    }
}