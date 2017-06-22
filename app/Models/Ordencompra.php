<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Validator;

class Ordencompra extends Model {

	protected $fillable = ['id_partida','id_empresa','condicion_pago', 'fecha_emision', 'fecha_entrega', 'uf', 'condicion_pago', 'tipo_plazo', 'numero', 'id_empresa_cargo'];

		protected $table = 'orden_compra';
		public $errors;
		public function isValid($data)
	    	{
			$rules = array(
			
			'id_partida' => 'required',
			'id_empresa' => 'required',
			'fecha_emision' =>'required|date_format:d-m-Y',
			'fecha_entrega' =>'required|date_format:d-m-Y',
			'uf' =>'required|numeric|min:1',
			'condicion_pago' => 'required',
			'tipo_plazo' => 'sometimes',
			'numero' => 'required|numeric',
			'id_empresa_cargo' => 'required|min:1',
			);

			$mensajes = array(
			
			'id_partida.required' => 'Debe indicar a qué partida pertenece',
			'id_empresa.required' => 'Debe indicar a qué empresa pertenece la Orden de Compra', 	
			'fecha_emision.required'  => 'El campo fecha de emisión es obligatorio',
			
			'fecha_entrega.required' => 'El campo fecha de entrega es obligatorio',
                        //'fecha_entrega.date_format' => 'El formato de la fecha es dd/mm/YYYY',
			'uf.required' => 'La cantidad en U.F es un valor obligatorio',
			'condicion_pago.required' => 'Debe indicar las condiciones de pago',
			'numero.required' => 'El número de la Orden de Compra es obligatorio',
			'tipo_plazo.sometimes' => 'Debe indicar los días de plazo',
			'id_empresa_cargo.required' => 'Debe indicar el cargo de la Orden de Compra',
	

			);


        
        $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}

	public function empresa() {

		return $this->belongsTo('App\Models\Empresa', 'id_empresa', 'id');	

	}	

	public function partida() {

		return $this->belongsTo('App\Models\Partida', 'id_partida', 'id');		

	}

	
	public function documento(){

                return $this->hasMany('App\Models\Documento');

        }

    public function item(){

                return $this->belongsToMany('App\Models\Item', 'orden_item' ,'id_item', 'id_orden');
        }



public $timestamps = false;

}

