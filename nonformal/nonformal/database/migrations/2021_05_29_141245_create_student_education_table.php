<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_education', function (Blueprint $table) {
            $table->id();
            $table->string('type_education');
            $table->string('sphere_education');
            $table->integer('duration')->unsigned();
            $table->string('duration_type')->default('month');
            $table->boolean('diploma')->default(0);
            $table->uuid('student_uuid')->unique();
            $table->uuid('student_education_uuid')->unique();
            $table->timestamps();

            $table->foreign('student_uuid')->references('student_uuid')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_education');
    }
}
