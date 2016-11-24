<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->increments('id');
			$table->string('user_id');
			$table->integer('type');
			$table->string('department');
			$table->date('apply_date');
			$table->string('name');
			$table->string('phone');
			$table->string('email');
			$table->text('purpose');
			$table->integer('way');
			$table->string('ip');
			$table->string('account');
			$table->string('password');
			$table->string('location');
			
			//form1 col
			$table->text('form1_need');
			
			//form2 col
			$table->integer('form2_need');
			$table->string('form2_need_other');
			$table->integer('form2_filter_enter');
			$table->integer('form2_filter_id');
			$table->integer('form2_filter_status');
			
			//form3 col
			$table->integer('form3_need');
			$table->integer('form3_sub_0');
			$table->integer('form3_sub_1');
			$table->integer('form3_sub_2');
			$table->integer('form3_sub_3');
			$table->integer('form3_sub_4');
			$table->integer('form3_sub_5');
			$table->integer('form3_sub_6');
			$table->integer('form3_sub_7');
			$table->integer('form3_sub_8');
			$table->integer('form3_sub_9');
			$table->integer('form3_sub_10');
			$table->integer('form3_sub_11');
			$table->integer('form3_sub_12');
			$table->integer('form3_sub_13');
			$table->integer('form3_filter_no');
			$table->string('form3_filter_department');
			$table->string('form3_filter_title');
			$table->date('form3_filter_start');
			$table->date('form3_filter_end');
			$table->string('form3_filter_program');
			$table->string('form3_filter_financial');
			$table->integer('form3_personal');
			
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
        Schema::drop('applies');
    }
}
