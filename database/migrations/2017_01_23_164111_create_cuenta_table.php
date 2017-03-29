<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuentaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuenta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_empresa');
			$table->integer('id_banco');
			$table->integer('tipo');
			$table->string('numero', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cuenta');
	}

}
