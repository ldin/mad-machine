<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUsersTable extends Migration {


        public function up()
	{
		Schema::create('project_users', function(Blueprint $table)
		{
            $table->increments('id');
            $table->smallInteger('project_id');
            $table->smallInteger('user_id');
            $table->smallInteger('connect');
            $table->smallInteger('watch');
            $table->text('is_admin');
            $table->text('comment');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('project_users');
	}

}
