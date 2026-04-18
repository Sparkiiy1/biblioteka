<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'isbn',
        'title',
        'author_id',
        'category_id',
        'publication_year',
        'publisher',
        'pages',
        'language',
        'total_copies',
        'available_copies',
        'description',
        'cover_image',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages' => 'integer',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
    ];

    // Attiecības
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookCopies(): HasMany
    {
        return $this->hasMany(BookCopy::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // Metodes
    public function isAvailable(): bool
    {
        return $this->available_copies > 0;
    }

    public function decrementCopies(): void
    {
        if ($this->available_copies > 0) {
            $this->decrement('available_copies');
        }
    }

    public function incrementCopies(): void
    {
        if ($this->available_copies < $this->total_copies) {
            $this->increment('available_copies');
        }
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('available_copies', '>', 0);
    }

    public function scopeByAuthor($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}