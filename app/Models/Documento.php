<?php

namespace App\Models;

use \Validator;


class Documento extends \Eloquent {
	protected $fillable = ['tipo', 'monto', 'fecha', 'id_orden', 'no_contabilidad' , 'rutadoc'];

	/**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'documento';

	public $errors;

public function isValid($data)
    	{
	$rules = array(
			
			'id_orden' => 'required',
			'tipo' => 'required',
			'no_contabilidad' => 'required',
			'monto' =>'required|min:3|max:7',
			'fecha' =>'required|date_format:d/m/Y',
			'rutadoc' => 'present|file',
	
			);
	$mensajes = array(
			'tipo.required' => 'Debe indicar un tipo de documento',
			'no_contabilidad.required'=> 'Debe indicar si es un documento contable',
			'monto.required'=> 'Debe indicar el monto del documento',
			'fecha.required' => 'Es necesaria la fecha',
			'fecha.date_format' => 'El formato de fecha es dd/mm/YYYY',
			'rutadoc.file' => 'El archivo debe ser menor a 20M',
			 

			);
	        
        $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}

	 public function ordencompra(){

                return $this->belongsTo('App\Models\Ordencompra', 'id_orden', 'id');
        }

    public function item(){

                return $this->belongsToMany('App\Models\Item', 'orden_item' ,'id_item', 'id_orden');
        }



public $timestamps = false;

}
