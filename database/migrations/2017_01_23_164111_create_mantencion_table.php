<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMantencionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mantencion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_equipo');
			$table->string('tipo', 500);
			$table->dateTime('fecha_inicio');
			$table->dateTime('fecha_termino');
			$table->string('repuesto', 500);
			$table->string('valor_repuesto', 50);
			$table->string('lugar_repuesto', 500);
			$table->string('nombre_taller', 500);
			$table->string('valor_taller', 50);
			$table->string('descripcion', 500);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mantencion');
	}

}
