<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_subject_id');
            $table->tinyinteger('semester')->nullable();
            $table->tinyinteger('sessional')->nullable();
            $table->tinyinteger('total')->nullable();
            $table->string('grade',5)->nullable();
            $table->tinyinteger('grade_points')->nullable();
            $table->tinyinteger('gp_earned')->nullable();
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
        Schema::drop('results');
    }
}
