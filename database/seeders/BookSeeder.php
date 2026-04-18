<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::insert([
            ['title'=>'War and Peace','author'=>'Leo Tolstoy','isbn'=>'9780140447934','published_year'=>1869,'copies_total'=>2,'copies_available'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Pride and Prejudice','author'=>'Jane Austen','isbn'=>'9780141199078','published_year'=>1813,'copies_total'=>3,'copies_available'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
