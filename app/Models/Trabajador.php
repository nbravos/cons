<?php

namespace App\Models;

use \Validator;

class Trabajador extends \Eloquent {
	protected $fillable = ['nombre', 'rut', 'email', 'telefono', 'direccion', 'id_afp', 'id_salud', 'fecha_nac', 'fecha', 'foto'];

	protected $table = 'trabajador';

	public $errors;


public function isValid($data)
    	{
	$rules = array(
			
			'nombre' => 'required|min:4|max:40',
			'rut' => 'required',
			'email' =>  'required|email|unique:empresa',
			'telefono' => 'required|min:8|max:11',
			'direccion' => 'required|min:5|max:40',
			'fecha_nac' => 'required',
			'fecha' =>'required',
			'id_afp' =>'required',
                        'id_salud' =>'required',
                        'foto' => 'image|max:3000|mimes:jpeg,jpg,bmp,png',			
			);
	$mensajes = array(
        'nombre.required' => 'El nombre del trabajador es obligatorio',
        'rut.required' => 'El formato del rut es xxxxxxxx-x',
        'email.required' => 'El correo electrónico del trabajador es obligatorio',
        'telefono.required' => 'El teléfono del trabajador es obligatorio',
        'direccion.required' => 'El campo direccion es obligatorio',
        'fecha_nac.required' => 'La fecha de nacimiento del trabajador es obligatoria',
        'fecha.required' => 'La fecha de ingreso es obligatoria',
        'id_afp.required' => 'Debe indicar a qué AFP se encuentra afiliado',
        'id_salud.required' => 'Debe indicar a qué Isapre se encuentra afiliado',
	'foto.max' => 'La imagen no debe superar los 3 MB formatos jpeg, jpg, bmp o png',


        );
        
        $validator = Validator::make($data, $rules, $mensajes);
       

        if ($validator->passes())
        {	
	     	    
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}
	public $timestamps = false;



}
