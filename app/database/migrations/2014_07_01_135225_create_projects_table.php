<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('projects', function ($table){
                $table->increments('id');
                $table->string('slug');
                $table->string('name');
                $table->string('title');
                $table->text('text');
                $table->text('target');
                $table->string('budjet');
                $table->string('shortText');
                $table->string('offer_name');
                $table->text('offer_text');
                $table->smallInteger('category_id');
                $table->string('tags');
                $table->smallInteger('status');
                $table->string('description');
                $table->string('keywords');
                $table->timestamps();
                $table->softDeletes();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('projects');
	}

}
