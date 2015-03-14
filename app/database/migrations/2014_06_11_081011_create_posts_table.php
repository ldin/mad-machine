<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('posts', function ($table){
                $table->increments('id');
                $table->string('slug');
                $table->string('type');
                $table->string('name');
                $table->string('title');
                $table->text('text');
                $table->string('shortText');
                $table->smallInteger('parent');
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
            Schema::drop('posts');	//
	}

}
