<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avance', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_partida');
			$table->integer('id_cuadrilla');
			$table->string('cantidad', 20);
			$table->string('porcentaje', 20);
			$table->dateTime('fecha_inicio');
			$table->dateTime('fecha_termino');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avance');
	}

}
