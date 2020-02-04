<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('enrol_id')->unsigned();
            $table->bigInteger('attendance_id')->unsigned();
            $table->string('attendance',2);
            $table->timestamps();

            $table->foreign('enrol_id')->references('id')->on('enrols');
            $table->foreign('attendance_id')->references('id')->on('attendances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stud_attendances');
    }
}
