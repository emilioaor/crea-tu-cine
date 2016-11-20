<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoviesTable extends Migration
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
            $table->string('title');
            $table->string('synopsis');
            $table->string('image');
            $table->string('download');
            $table->integer('year');
            $table->string('slug');
            $table->string('trailer');
            $table->string('online');
            $table->string('uploaded');
            $table->string('turbobit');
            $table->string('thevideos');
            $table->string('thevideos2');
            $table->string('completa');
            $table->integer('id_relation')->unsigned()->nullable();
            $table->foreign('id_relation')->references('id')->on('relations');
            $table->timestamps();
        });

        Schema::create('movies_genres',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_movie')->unsigned();
            $table->integer('id_genre')->unsigned();
            $table->foreign('id_movie')->references('id')->on('movies');
            $table->foreign('id_genre')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movies_genres');
        Schema::drop('movies');
    }
}
