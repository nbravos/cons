<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('rut', 20);
			$table->string('nombre', 200);
			$table->string('razon_social', 300);
			$table->string('giro', 300);
			$table->string('nombre_contacto', 100);
			$table->string('email', 100);
			$table->string('telefono', 50);
			$table->string('direccion', 200);
			$table->string('web', 50);
			$table->integer('tipo_empresa');
			$table->integer('tipo_proovedor');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresa');
	}

}
