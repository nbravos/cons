<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuadrilla extends Model
{
    protected $table = 'cuadrilla';

    protected $fillable = ['id_partida', 'nombre', 'descripcion'];

    public $timestamps = false;

    	public function isValid($data)
    	{
	$rules = array(
		'nombre' => 'required|min:4|max:40',
		'id_partida' => 'required',
		'descripcion' => 'required|min:5|max:100',
		);

	$mensajes = array(
		'nombre.required' => 'El nombre de la cuadrilla es obligatorio',
		'id_partida.required' => 'Debe indicar la partida a la que pertenece',
		'descripcion.required' => 'Debe agregar una breve descripción',



		);
	
	 $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}


	public function trabajadores(){

		return $this->belongsToMany('App\Models\Trabajador', 'cuadrilla_trabajador', 'id_cuadrilla', 'id_trabajador');
	}

	public function partidas(){
		return $this->hasOne('App\Models\Partida');
	}

	public function equipos(){
		return $this->hasOnde('App\Models\Equipo');
	}



}
