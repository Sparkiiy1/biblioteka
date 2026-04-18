<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->unique();
            $table->integer('published_year')->nullable(); // changed: use integer for compatibility
            $table->integer('copies_total')->default(1);
            $table->integer('copies_available')->default(1);
            $table->softDeletes(); // added: support SoftDeletes to avoid "books.deleted_at" not found
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
