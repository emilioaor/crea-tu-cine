<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->string('synopsis');
            $table->integer('year');
            $table->string('slug', 80);
            $table->string('image', 80);
            $table->text('trailer');
            $table->string('status', 20);
            $table->integer('cine_id')->unsigned();
            $table->integer('relation_id')->unsigned()->nullable();
            $table->foreign('cine_id')->references('id')->on('cinemas');
            $table->foreign('relation_id')->references('id')->on('relations');
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
        Schema::drop('movies');
    }
}
