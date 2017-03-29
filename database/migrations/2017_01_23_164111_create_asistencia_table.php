<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsistenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asistencia', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_trabajador');
			$table->integer('horas');
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
		Schema::drop('asistencia');
	}

}
