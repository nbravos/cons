<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdenCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orden_compra', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_partida');
			$table->integer('id_empresa');
			$table->integer('id_empresa_cargo');
			$table->string('numero', 200);
			$table->string('uf', 30);
			$table->string('condicion_pago', 200);
			$table->dateTime('fecha_emision');
			$table->dateTime('fecha_entrefa');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orden_compra');
	}

}
