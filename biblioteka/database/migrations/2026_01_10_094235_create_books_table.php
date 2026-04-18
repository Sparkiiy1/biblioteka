<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 17)->unique();
            $table->string('title', 255);
            $table->foreignId('author_id')->constrained('authors')->restrictOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->integer('publication_year');
            $table->string('publisher', 200)->nullable();
            $table->integer('pages')->nullable();
            $table->string('language', 50)->default('Latviešu');
            $table->integer('total_copies')->default(1);
            $table->integer('available_copies')->default(1);
            $table->text('description')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('title', 'idx_title');
            $table->index('publication_year', 'idx_publication_year');
            
            // Constraints
            $table->check('total_copies', 'total_copies >= 0');
            $table->check('available_copies', 'available_copies >= 0');
            $table->check('available_copies', 'available_copies <= total_copies');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};