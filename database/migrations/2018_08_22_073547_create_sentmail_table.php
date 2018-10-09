<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSentmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sentmail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('from')->nullable();
			$table->binary('body', 65535)->nullable();
			$table->timestamps();
			$table->text('subject', 65535)->nullable();
			$table->boolean('attachment')->nullable()->default(0);
			$table->string('received_date')->nullable();
			$table->string('from_email')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sentmail');
	}

}
