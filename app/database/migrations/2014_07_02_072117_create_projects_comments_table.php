<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('project_comments', function ($table){
                $table->increments('id');
                $table->smallInteger('project_id');
                $table->smallInteger('user_id');
                $table->text('text');
                $table->string('status');
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
            Shema::drop('project_comments');
	}

}
