<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrabajadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trabajador', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 200);
			$table->string('rut', 20);
			$table->string('email', 100);
			$table->string('telefono', 40);
			$table->string('direccion', 200);
			$table->integer('id_afp');
			$table->integer('id_salud');
			$table->dateTime('fecha_nac')->nullable();
			$table->dateTime('fecha');
			$table->binary('foto', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trabajador');
	}

}
