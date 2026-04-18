<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'copies_total',
        'copies_available',
    ];

    // relations
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}