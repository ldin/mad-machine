<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('partners', function ($table){
                $table->increments('id');
                $table->string('slug');
                $table->string('name');
                $table->string('title');
                $table->string('type');
                $table->text('text');
                $table->text('shortText');
                $table->string('logo');
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
            Schema::drop('partners');	
	}

}
