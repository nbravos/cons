<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuadrillaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuadrilla', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_partida');
			$table->string('nombre', 100);
			$table->string('descripcion', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cuadrilla');
	}

}
