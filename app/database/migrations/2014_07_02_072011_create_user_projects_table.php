<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('user_projects', function ($table){
                $table->increments('id');
                $table->smallInteger('project_id');
                $table->smallInteger('user_id');
                $table->string('role');
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
            Schema::drop('user_projects');
	}

}
