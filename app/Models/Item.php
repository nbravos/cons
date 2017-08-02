<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use \Validator;

class Item extends \Eloquent {


    protected $fillable = ['cantidad', 'detalle', 'unidad', 'unitario', 'id_item_dos'];

    protected $table ='item';

    public $errors;

/*   public function isValid($data)
    	{
	$rules = array(
			
			
			'cantidad' => 'required',
			'detalle' =>'required|min:3',
			'unidad' =>'required',
			'unitario' => 'required|numeric',
	
			);
	$mensajes = array(
			'cantidad.required' => 'Debe indicar la cantidad',
			'detalle.required'=> 'Debe indicar el detalle del item',
			'unidad.required'=> 'Debe indicar el monto del item',
			'unitario.required' => 'Debe indicar el valor unitario del item',
			 

			);
	        
        $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}*/


	public function ordencompra(){

                return $this->belongsToMany('App\Models\Ordencompra', 'orden_item' ,'id_item', 'id_orden'); 
        }

   	public function documento(){

                return $this->belongsToMany('App\Models\Documento', 'documento_item', 'id_item', 'id_documento');
    }



	public $timestamps = false;

}
