<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuadrillaEquipoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuadrilla_equipo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_cuadrilla');
			$table->integer('id_equipo');
			$table->dateTime('fecha');
			$table->integer('estado');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cuadrilla_equipo');
	}

}
