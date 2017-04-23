<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableStylesCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('selector', 50);
            $table->string('name', 30);
            $table->string('label', 30);
            $table->string('property', 30);
            $table->string('value', 30);
            $table->integer('cine_id')->unsigned();
            $table->foreign('cine_id')->references('id')->on('cinemas');
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
        Schema::drop('styles');
    }
}
