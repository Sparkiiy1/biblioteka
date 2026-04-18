<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDeletedAtToBooksTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('books') && !Schema::hasColumn('books', 'deleted_at')) {
            try {
                Schema::table('books', function (Blueprint $table) {
                    $table->softDeletes();
                });
            } catch (\Throwable $e) {
                // Fallback: raw SQL if Schema builder fails on this environment
                DB::statement("ALTER TABLE `books` ADD `deleted_at` TIMESTAMP NULL");
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('books') && Schema::hasColumn('books', 'deleted_at')) {
            try {
                Schema::table('books', function (Blueprint $table) {
                    $table->dropColumn('deleted_at');
                });
            } catch (\Throwable $e) {
                // Fallback: raw SQL to drop column
                DB::statement("ALTER TABLE `books` DROP COLUMN `deleted_at`");
            }
        }
    }
}
