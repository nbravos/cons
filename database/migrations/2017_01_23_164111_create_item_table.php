<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('cantidad', 20);
			$table->string('detalle', 100);
			$table->string('unidad', 20);
			$table->string('unitario', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item');
	}

}
