<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->text('biography')->nullable();
            $table->string('country', 100)->nullable();
            $table->integer('birth_year')->nullable();
            $table->timestamps();
            
            $table->index(['last_name', 'first_name'], 'idx_author_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
