<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->restrictOnDelete();
            $table->foreignId('member_id')->constrained('members')->restrictOnDelete();
            $table->date('loan_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['active', 'returned', 'overdue', 'lost'])->default('active');
            $table->integer('renewal_count')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('status', 'idx_status');
            $table->index('due_date', 'idx_due_date');
            $table->index(['member_id', 'status'], 'idx_member_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};