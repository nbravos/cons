<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSueldoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sueldo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_trabajador');
			$table->string('liquido', 40);
			$table->string('imponible', 40);
			$table->string('des_afp', 40);
			$table->string('des_salud', 40);
			$table->string('bonos', 40);
			$table->integer('horas_extras');
			$table->integer('dias_trabajados');
			$table->integer('dias_no_trabajados');
			$table->string('cesantia', 40);
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
		Schema::drop('sueldo');
	}

}
