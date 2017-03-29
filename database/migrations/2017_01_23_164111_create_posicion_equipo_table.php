<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosicionEquipoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posicion_equipo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_equipo');
			$table->string('lat', 10);
			$table->string('lon', 10);
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
		Schema::drop('posicion_equipo');
	}

}
