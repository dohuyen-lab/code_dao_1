<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('intitule', 50)->nullable(false);
            $table->integer('user_id')->unsigned()->nullable(false);
            $table->integer('formation_id')->unsigned();

            $table->timestamps();

            $table->foreign('formation_id')->references('id')->on('formations');
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
        Schema::dropIfExists('cours');
    }
}
