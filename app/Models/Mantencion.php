<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantencion extends Model
{
    protected $table = 'mantencion';
	protected $fillable =['id_equipo', 'tipo', 'fecha_inicio', 'fecha_termino', 'repuesto', 'valor_repuesto', 'lugar_repuesto', 'nombre_taller', 'valor_taller', 'descripcion', 'total'];
	public $timestamps = false;


	public function isValid($data)
    	{
	$rules = array(
			
			'id_equipo' => 'required',
			'tipo' => 'required',
			'fecha_inicio' =>'required|date_format:d/m/Y',
			'fecha_termino' =>'required|date_format:d/m/Y',
			'valor_repuesto' => 'required',
			'lugar_repuesto' => 'required',
			'nombre_taller' => 'required',
			'valor_taller' => 'required',
			'descripcion' =>'required',
			
	
			);
	$mensajes = array(

			'tipo.required' => 'Debe indicar el tipo de mantención',
			'fecha_inicio.required' => 'El formato de fecha es dd/mm/YYYY',
			'fecha_termino' =>'El formato de fecha es dd/mm/YYYY',
			'valor_repuesto.required' => 'Debe indicar el valor del repuesto',
			'lugar_repuesto.required' => 'Debe indicar dónde adquirió el repuesto',
			'nombre_taller.required' => 'Debe indicar el taller que realizó la mantención',
			'valor_taller.required' => 'Debe indicar el costo del taller',
			'descripcion.required' =>'Debe indicar una breve descripción de la mantención',
			
			 

			);
	        
        $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}

	public function equipo()
        {

                return $this->belongsTo('App\Models\Equipo', 'id_equipo', 'id');

        }

	public function fotosmantencion()
	{
		return $this->hasMany('App\Models\Fotosmantencion');	
	}
}


