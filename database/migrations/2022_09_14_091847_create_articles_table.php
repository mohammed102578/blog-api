<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->text('body');
			$table->string('author', 255);
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}