<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvancePagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avance_pago', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_documento');
			$table->string('monto', 20);
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
		Schema::drop('avance_pago');
	}

}
