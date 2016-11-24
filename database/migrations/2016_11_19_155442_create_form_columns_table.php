<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_columns', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('form')->unsigned();
            $table->integer('block')->unsigned();
			$table->integer('sub_block')->unsigned();
            $table->integer('index');
            $table->string('name');
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
        Schema::drop('form_columns');
    }
}
