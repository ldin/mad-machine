<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('users', function($table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('name');
                $table->string('password');
                $table->string('phone', 100);
                $table->text('description');
                $table->smallInteger('status');
                $table->boolean('isActive');
                $table->string('activationCode');
                $table->string('remember_token', 100);
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
            Schema::drop('users');	//
	}

}
