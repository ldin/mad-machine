<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryUsersTable extends Migration {

        public function up()
	{
		Schema::create('category_user', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->smallInteger('category_id');
                    $table->smallInteger('user_id');
                    $table->smallInteger('status')->default('1');
                    $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('category_users');
	}

}
