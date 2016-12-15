<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','100');
            $table->string('subject_code',20)->nullable();
            $table->tinyinteger('course_id');
            $table->integer('semester');
            $table->tinyinteger('credit')->nullable();
            $table->tinyinteger('fullmark')->nullable();
            $table->tinyinteger('passmark')->nullable();
            $table->tinyinteger('ia_fullmark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subjects');
    }
}
