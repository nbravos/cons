<?php

namespace App\Models;
use \Validator;
class Empresa extends \Eloquent {
	protected $fillable = ['nombre', 'razon_social', 'giro', 'nombre_contacto', 'email', 'telefono', 'direccion', 'web', 'rut', 'tipo_empresa', 'tipo_proovedor'];

	protected $table = 'empresa';

	public $errors;

	public $timestamps = false;

	public function isValid($data)
    	{
	$rules = array(
			
			'nombre' => 'required|min:4|max:40',
			'razon_social' => 'required|min:4|max:40',
			'giro' =>'required|min:4|max:40',
			'nombre_contacto' =>'required|min:4|max:40',
			'email' =>  'required|email|unique:empresa',
			'telefono' => 'required|min:8|max:11',
			'direccion' => 'required|min:5|max:40',
			'web' => 'required|min:5',
			'rut' => 'required|min:10',
			'tipo_empresa' => 'required',
			
			);
	$mensajes =  array(
			'nombre.required'=> 'Campo nombre  Empresa es obligatorio',
			'razon_social.required' => 'Campo razón social es obligatorio', 
			'giro.required' => 'Campo giro Empresa es obligatorio', 
			'nombre_contacto.required' => 'Campo nombre de contacto es obligatorio', 
			'email.required' => 'Campo correo de contacto es obligatorio',
			'telefono.required' => 'Campo teléfono de Empresa es obligatorio',
			'direccion.required' => 'Campo dirección es obligatorio',
			'web.required' => 'El sitio web de la empresa es obligatorio',
			'rut.required' => 'El rut de la empresa es obligatorio',
			'tipo_empresa.required' => 'Debe indicar si es proveedor, mandante u contratista',
			'email.unique' => 'El correo ingresado ya existe',

			);

	if ($this->exists)
        {
               //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
		$rules['email'] .= ',email,' . $this->id;
        }
	
	else 
        {
            
        }        

        $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}

/* public function rutValidation($value='')
	{
	# code...
	}
	public function validAndSafe($data)
	{
		
	}*/

	public function ordencompra(){

		return $this->hasMany('App\Models\Ordencompra');

	}

	public function proyecto(){

		return $this->hasMany('App\Models\Proyecto', 'id_empresa', 'id');

	}

	/*public function proyectocontratista(){

                return $this->hasOne('App\Models\Proyectocontratista');
        }*/

}
