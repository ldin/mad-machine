<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('messages', function ($table){
                $table->increments('id');
                $table->smallInteger('sender_id');
                $table->smallInteger('addressee_id');
                $table->smallInteger('project_id');
                $table->string('theme');
                $table->text('message');
                $table->boolean('sender_status');
                $table->boolean('addressee_status');
                $table->boolean('isread');
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
            Schema::drop('messages');	
	}

}
