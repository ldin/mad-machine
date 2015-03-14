<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('stage', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255);
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
        Schema::drop('stage');
	}

}
