<?php

namespace App\Services;

use App\Models\Book;

class LibraryCatalog
{
    protected array $byIsbn = [];

    public function __construct()
    {
        $this->loadFromDatabase();
    }

    // Load all books into in-memory map keyed by ISBN
    public function loadFromDatabase(): void
    {
        $this->byIsbn = [];
        foreach (Book::all() as $b) {
            $this->byIsbn[$b->isbn] = $b->toArray();
        }
    }

    // Persist a book to DB and update cache
    public function addBook(array $data): Book
    {
        $book = Book::updateOrCreate(['isbn'=>$data['isbn']], $data);
        $this->byIsbn[$book->isbn] = $book->toArray();
        return $book;
    }

    public function deleteByIsbn(string $isbn): bool
    {
        if (!isset($this->byIsbn[$isbn])) return false;
        Book::where('isbn',$isbn)->delete();
        unset($this->byIsbn[$isbn]);
        return true;
    }

    // Simple search: by title or author (case-insensitive substring)
    public function search(string $q): array
    {
        $q = mb_strtolower($q);
        $results = [];
        foreach ($this->byIsbn as $item) {
            if (mb_stripos($item['title'],$q) !== false || mb_stripos($item['author'],$q) !== false) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function getAll(): array
    {
        return array_values($this->byIsbn);
    }
}
