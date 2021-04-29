<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('nom', 40);
            $table->string('prenom', 40);
            $table->string('login', 30)->nullable(false)->unique();
            $table->string('mdp', 60)->nullable(false);
            $table->integer('formation_id')->unsigned();
            $table->string('type', 10)->nullable();
            $table->timestamps();

            $table->foreign('formation_id')->references('id')->on('formations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
