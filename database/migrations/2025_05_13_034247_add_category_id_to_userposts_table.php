<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToUserpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('userposts', 'category_id')) {
            Schema::table('userposts', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->after('image_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('userposts', function (Blueprint $table) {
                // 1. Drop foreign key first (best practice)
                $table->dropForeign(['category_id']);
    
        });
    }
}
