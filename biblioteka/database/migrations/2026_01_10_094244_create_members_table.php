<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('membership_number', 20)->unique();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('personal_code', 12)->unique();
            $table->string('email', 255)->unique();
            $table->string('phone', 20);
            $table->text('address');
            $table->date('date_of_birth');
            $table->enum('status', ['active', 'suspended', 'inactive'])->default('active');
            $table->date('membership_start');
            $table->date('membership_expiry');
            $table->integer('max_loans')->default(5);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('status', 'idx_status');
            $table->index(['last_name', 'first_name'], 'idx_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};