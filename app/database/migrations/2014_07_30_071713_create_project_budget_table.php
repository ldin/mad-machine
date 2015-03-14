<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectBudgetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_budgets', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->smallInteger('project_id');
                    $table->smallInteger('user_id');
                    $table->text('budget');
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
		Schema::drop('project_budgets');
	}

}
