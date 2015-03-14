<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('project_news', function ($table){
                $table->increments('id');
                $table->smallInteger('project_id');
                $table->smallInteger('user_id');
                $table->string('slug');
                $table->string('name');
                $table->string('title');
                $table->text('text');
                $table->string('shortText');
                $table->string('tags');
                $table->smallInteger('status');
                $table->string('description');
                $table->string('keywords');
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
            Schema::drop('project_news');
	}

}
