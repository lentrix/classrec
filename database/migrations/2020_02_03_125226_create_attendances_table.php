<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('my_class_id')->unsigned();
            $table->date('date');
            $table->smallInteger('grading')->default(1);//1-midterm, 2-final
            $table->string('remarks')->nullable();
            $table->boolean('interactive')->default(0);

            $table->foreign('my_class_id')->references('id')->on('my_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
