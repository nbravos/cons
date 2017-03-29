<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonoTrabajadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bono_trabajador', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_trabajador');
			$table->integer('id_bono');
			$table->string('monto', 40);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bono_trabajador');
	}

}
