<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partida', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_proyecto');
			$table->string('item', 10);
			$table->string('detalle', 200);
			$table->string('unidad', 50);
			$table->string('cantidad', 50);
			$table->string('unitario', 10);
			$table->string('total', 20);
			$table->dateTime('inicio_teorico')->nullable();
			$table->dateTime('fin_teorico')->nullable();
			$table->dateTime('inicio_real')->nullable();
			$table->dateTime('fin_real')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('partida');
	}

}
