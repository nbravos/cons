<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProyectoContratistaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proyecto_contratista', function(Blueprint $table)
		{
			$table->integer('id_proyecto', true);
			$table->integer('id_empresa');
			$table->string('monto_ofertado', 50);
			$table->integer('bases');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proyecto_contratista');
	}

}
