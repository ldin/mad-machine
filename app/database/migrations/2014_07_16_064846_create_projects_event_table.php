<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('project_events', function ($table){
                $table->increments('id');
                $table->smallInteger('project_id');
                $table->string('name');
                $table->string('slug');
                $table->string('start');
                $table->string('end');
                $table->smallInteger('part');
                $table->smallInteger('parent');
                $table->text('text');
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
            Shema::drop('project_events');
		//
	}

}
