<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name', 60);
            $table->string('description');
            $table->string('schedule')->nullable();
            $table->string('venue',60)->nullable();
            $table->string('sem', 60)->nullable();
            $table->string('code')->unique();
            $table->boolean('active')->default(1);
            $table->integer('quiz_weight')->default(1);
            $table->integer('part_weight')->default(1);
            $table->integer('exam_weight')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_class');
    }
}
