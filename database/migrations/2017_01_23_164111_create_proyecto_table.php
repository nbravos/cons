<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProyectoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proyecto', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_empresa');
			$table->integer('id_comuna');
			$table->integer('tipo_licitacion');
			$table->string('nombre', 300);
			$table->string('financiamiento', 100);
			$table->string('monto_disponible', 100);
			$table->integer('monto_minimo_oferta');
			$table->string('monto_ofertado', 100);
			$table->string('presupuesto_oficial', 100);
			$table->string('costos_directos', 20)->nullable();
			$table->string('costos_generales', 20)->nullable();
			$table->dateTime('fecha_licitacion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proyecto');
	}

}
