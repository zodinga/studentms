<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStudentForiegnKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('course','course_id');
            $table->renameColumn('category','category_id');
            $table->renameColumn('community','community_id');
            $table->renameColumn('status','status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('course_id','course');
            $table->renameColumn('category_id','category');
            $table->renameColumn('community_id','community');
            $table->renameColumn('status_id','status');
        });
    }
}
