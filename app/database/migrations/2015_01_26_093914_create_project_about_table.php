<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAboutTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_about', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->smallInteger('project_id');
                    $table->text('text');
                    $table->text('shortText');
                    $table->string('mart');
                    $table->string('logo');
                    $table->smallInteger('irr');
                    $table->smallInteger('pi');
                    $table->smallInteger('npv');
                    $table->smallInteger('stage_id');
                    $table->string('stageComment');
                    $table->text('keyFactors');
					$table->string('needInvest');
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
		Schema::drop('project_about');
	}

}
