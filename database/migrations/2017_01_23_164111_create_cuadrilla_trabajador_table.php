<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuadrillaTrabajadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuadrilla_trabajador', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_cuadrilla');
			$table->integer('id_trabajador');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cuadrilla_trabajador');
	}

}
