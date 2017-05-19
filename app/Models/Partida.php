<?php 

namespace App\Models;

use \Validator;

class Partida extends \Eloquent {
	protected $fillable = ['id', 'nombre', 'id_proyecto', 'item', 'detalle', 'unidad', 'cantidad', 'unitario', 'total', 'inicio_teorico', 'inicio_real', 'fin_teorico', 'fin_real'];
	
	protected $table = 'partida'; 

	public $errors;

	public $timestamps = false;


	public function isValid($data)
                {
                        $rules = array(

                        'nombre' => 'required|min:1',                       
                        'id_proyecto' => 'required',
                        'item' =>'required|numeric|min:1',
                        'detalle' => 'required|min:1',
                        'unidad' =>'required|min:1',
                        'cantidad' =>'required|numeric|min:1',
                        'unitario' => 'required|numeric|min:1',
                        'total' => 'numeric',
			'inicio_teorico' => 'date_format:d-m-Y',
			'inicio_real' => 'sometimes',
                        'fin_teorico' => 'date_format:d-m-Y',
                        'fin_real' => 'sometimes',
                        );

			
$mensajes = array(
        'nombre.required' => 'El nombre de la partida es obligatorio',
        'id_proyecto.required' => 'Debe indicar el proyecto asociado',
        'item.required' => 'Debe indicar el item de la partida',
        'detalle.required' => 'Debe indicar el detalle de la partida',
        'cantidad.required' => 'El campo cantidad es obligatorio',
	'cantidad.numeric' => 'El valor debe ser numérico',
	'unidad.required' => 'Debe indicar el número de unidades',
	'unidad.numeric' => 'El valor debe ser numérico', 
        'unitario.required' => 'El valor unitario es obligatorio',
        'total.numeric' => 'El campo total debe ser numérico',
        'inicio_teorico.date_format' => 'La fecha de inicio teórica es obligatoria',
        //'inicio_real.date_format' => 'La fecha de inicio real es obligatoria',
        'fin_teorico.date_format' => 'La fecha de término teórica es obligatoria',
        //'fin_real.date_format' => 'La fecha de término real es obligatoria',
	'item.numeric' => 'Item debe ser un valor numérico',


        );


        $validator = Validator::make($data, $rules, $mensajes);

        if ($validator->passes())
        {

            return true;
        }

        $this->errors = $validator->errors();
		return false;
        }

	public function proyecto() 
	{

		return $this->belongsTo('App\Models\Proyecto', 'id_proyecto', 'id');
	
	}

	public function ordencompra()
	{

		return $this->hasMany('App\Models\Ordencompra');

	}

}

