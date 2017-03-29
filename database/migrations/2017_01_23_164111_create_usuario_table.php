<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100);
			$table->string('email', 50);
			$table->string('password', 600);
			$table->integer('roles');
			
			
		});
	
		/*Schema::table('usuario', function($table)
		{
	
			$table->rememberToken();


		})*/
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
