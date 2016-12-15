<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('aadhaar',20)->nullable();
            $table->string('eid',10)->nullable();
            $table->string('phone',12)->nullable();
            $table->string('email',30)->nullable();
            $table->string('inst_no',20)->nullable();
            $table->string('univ_reg_no',30)->nullable();
            $table->string('exam_roll_no',20)->nullable();
            $table->string('doj',4)->nullable();
            $table->tinyinteger('course')->unsigned()->nullable();
            $table->tinyinteger('batch')->unsigned()->nullable();
            $table->string('fathers_me',40)->nullable();
            $table->string('mothers_me',40)->nullable();
            $table->string('parents_phone',12)->nullable();
            $table->string('guardian_me',40)->nullable();
            $table->string('guardian_phone',12)->nullable();
            $table->date('dob')->nullable();
            $table->string('sex',1)->nullable();
            $table->tinyinteger('category')->unsigned()->nullable();
            $table->tinyinteger('community')->unsigned()->nullable();
            $table->string('per_street',100)->nullable();
            $table->string('per_city',30)->nullable();
            $table->string('per_district',30)->nullable();
            $table->string('per_state',30)->nullable();
            $table->string('per_pin',10)->nullable();
            $table->string('pre_street',100)->nullable();
            $table->string('pre_city',30)->nullable();
            $table->string('pre_district',30)->nullable();
            $table->string('pre_state',30)->nullable();
            $table->string('pre_pin',10)->nullable();
            $table->tinyinteger('status')->unsigned()->nullable();
            $table->date('status_update_date')->nullable();
            $table->string('photo',30)->nullable();
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
        Schema::drop('students');
    }
}
