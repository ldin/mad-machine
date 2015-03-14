<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('requests', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->string('email', 255);
            $table->text('text');
            $table->boolean('status');
            $table->timestamps();
        });
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}

}
