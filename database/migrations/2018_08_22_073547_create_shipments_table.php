<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('customer', 256);
			$table->string('file')->nullable();
			$table->string('ff')->nullable();
			$table->string('shipline')->nullable();
			$table->string('contnr')->nullable();
			$table->date('last_del')->nullable();
			$table->date('doc_co')->nullable();
			$table->date('pier_co')->nullable();
			$table->string('rep')->nullable();
			$table->bigInteger('items')->nullable();
			$table->bigInteger('cases')->nullable();
			$table->string('shpd', 256)->nullable();
			$table->string('line')->nullable();
			$table->text('comments')->nullable();
			$table->timestamps();
			$table->string('attachments')->nullable();
			$table->boolean('active')->default(1);
			$table->string('week')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shipments');
	}

}
