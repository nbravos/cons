<?php

namespace App\Models;

use \Validator;

class Trabajador extends \Eloquent {
	protected $fillable = ['nombre', 'ap_paterno', 'ap_materno','rut', 'email', 'telefono', 'direccion', 'id_afp', 'id_salud', 'fecha_nac', 'fecha', 'fecha_termino', 'estado_contrato', 'foto'];

	protected $table = 'trabajador';

	public $errors;


public function isValid($data)
    	{
	$rules = array(
			
			'nombre' => 'required|min:4|max:40',
            'ap_paterno' => 'required|min:4|max:40',
            'ap_materno' => 'required|min:4|max:40',
			'rut' => 'required',
			'email' =>  'required|email|unique:empresa',
			'telefono' => 'required|min:8|max:11',
			'direccion' => 'required|min:5|max:40',
			'fecha_nac' => 'required',
			'fecha' =>'required',
            'fecha_termino' => 'required',
            'estado_contrato' => 'required',
			'id_afp' =>'required',
            'id_salud' =>'required',
            'foto' => 'image|max:3000|mimes:jpeg,jpg,bmp,png',			
			);
	$mensajes = array(
        'nombre.required' => 'El nombre del trabajador es obligatorio',
        'ap_paterno.required' => 'El apellido paterno del trabajador es obligatorio',
        'ap_materno.required' => 'El apellido materno del trabajador es obligatorio',
        'rut.required' => 'El formato del rut es 12345678-9',
        'email.required' => 'El correo electrónico del trabajador es obligatorio',
        'telefono.required' => 'El teléfono del trabajador es obligatorio',
        'direccion.required' => 'El campo direccion es obligatorio',
        'fecha_nac.required' => 'La fecha de nacimiento del trabajador es obligatoria',
        'fecha.required' => 'La fecha de ingreso es obligatoria',
        'fecha_termino.required' => 'La fecha de término de contrato es obligatoria',
        'estado_contrato.required' => 'Debe indicar si el contrato del trabajador se encuentra o no vigente',
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

    public function isValidUpdate($data)
        {
    $rules = array(
            
            'nombre' => 'required|min:4|max:40',
            'ap_paterno' => 'required|min:4|max:40',
            'ap_materno' => 'required|min:4|max:40',
            'rut' => 'required',
            'email' =>  'required|email|unique:empresa',
            'telefono' => 'required|min:8|max:11',
            'direccion' => 'required|min:5|max:40',
            'fecha_nac' => 'required',
            'fecha' =>'required',
            'fecha_termino' => 'required',
            'estado_contrato' => 'required',
            'id_afp' =>'required',
            'id_salud' =>'required',
            );
    $mensajes = array(
        'nombre.required' => 'El nombre del trabajador es obligatorio',
        'ap_paterno.required' => 'El apellido paterno del trabajador es obligatorio',
        'ap_materno.required' => 'El apellido materno del trabajador es obligatorio',
        'rut.required' => 'El formato del rut es xxxxxxxx-x',
        'email.required' => 'El correo electrónico del trabajador es obligatorio',
        'telefono.required' => 'El teléfono del trabajador es obligatorio',
        'direccion.required' => 'El campo direccion es obligatorio',
        'fecha_nac.required' => 'La fecha de nacimiento del trabajador es obligatoria',
        'fecha.required' => 'La fecha de ingreso es obligatoria',
        'fecha_termino.required' => 'La fecha de término de contrato es obligatoria',
        'estado_contrato.required' => 'Debe indicar si el contrato del trabajador se encuentra o no vigente',
        'id_afp.required' => 'Debe indicar a qué AFP se encuentra afiliado',
        'id_salud.required' => 'Debe indicar a qué Isapre se encuentra afiliado',

        );
        
        $validator = Validator::make($data, $rules, $mensajes);
       

        if ($validator->passes())
        {   
                
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }
    public function validaFoto($foto) {
        $rules = array(
             'foto' => 'image|max:3000|mimes:jpeg,jpg,bmp,png'
             );
        $mensajes = array(
            'foto.max' => 'La imagen no debe superar los 3 MB formatos jpeg, jpg, bmp o png'

            );

        $validator = Validator::make($foto, $rules, $mensajes);
       

        if ($validator->passes())
        {   
                
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;

    }

	public function cuadrillas()
	{
		return $this->belongsToMany('App\Models\Cuadrilla', 'cuadrilla_trabajador', 'id_trabajador', 'id_cuadrilla');

	}

	 public function proyecto()
        {

                return $this->belongsToMany('App\Models\Proyecto', 'proyecto_trabajador', 'id_trabajador', 'id_proyecto');

        }


	public $timestamps = false;



}
