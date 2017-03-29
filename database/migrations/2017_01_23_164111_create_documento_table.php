<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_orden');
			$table->integer('tipo');
			$table->string('monto', 20);
			$table->integer('no_contabilidad');
			$table->dateTime('fecha');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documento');
	}

}
