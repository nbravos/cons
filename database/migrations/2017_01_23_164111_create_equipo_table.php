<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 200);
			$table->string('codigo', 100);
			$table->string('costo', 100);
			$table->string('descripcion', 400);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipo');
	}

}
