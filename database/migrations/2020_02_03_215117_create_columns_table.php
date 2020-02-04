<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('my_class_id')->unsigned();
            $table->string('title');
            $table->string('component');//exam, quiz, participation
            $table->smallInteger('grading'); //1-midterm, 2-final
            $table->integer('total');
            $table->timestamps();
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
        Schema::dropIfExists('columns');
    }
}
