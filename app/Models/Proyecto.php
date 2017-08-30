<?php  namespace App\Models;

use \Validator;

class Proyecto extends \Eloquent {
	protected $fillable = ['id', 'id_empresa', 'id_comuna', 'tipo_licitacion', 'nombre', 'financiamiento', 'monto_disponible', 'monto_minimo_oferta', 'monto', 'monto_ofertado', 'presupuesto_oficial', 'costos_directos', 'gastos_generales', 'fecha_licitacion', 'estado', 'activo'];
	protected $table = 'proyecto';
	public $errors;
	
	
	public $timestamps = false;

	public function isValid($data)
                {
                        $rules = array(

                        'id_comuna' => 'required|',                       
                        'id_empresa' => 'required|',
			'tipo_licitacion' => 'sometimes', 
                        'nombre' =>'required|max:100',
                        'financiamiento' => 'required',
                        'monto_disponible' =>'sometimes|numeric',
                        'monto_minimo_oferta' =>'sometimes|numeric',
                        'monto_ofertado' => 'sometimes|numeric',
			'presupuesto_oficial' => 'sometimes|numeric',
			'costos_directos' => 'numeric',
                        'gastos_generales' => 'numeric',
                        'fecha_licitacion' => 'required|date_format:d/m/Y',
		        'estado' => 'required', 
			'ide' => 'required',
			'tipo_proyecto' => 'required', 
			'activo' => 'required',
                        );
	$mensajes = array (

		'tipo_licitacion.sometimes' => 'El campo tipo de Licitación es Obligatorio',
		'id_comuna.required' => 'El campo comuna es obligatorio',
		'nombre.required' => 'El campo nombre es obligatorio',
		'financiamiento.required' => 'Debe indicar el tipo de financiamiento',
		'monto_disponible.numeric' => 'El valor del monto disponible debe ser numérico',
		'monto_minimo_oferta.numeric' => 'El valor de la oferta mínima debe ser numérico',
		'monto_ofertado.numeric' => 'El valor del monto ofertado debe ser numérico',
		'presupuesto_oficial.numeric' => 'El valor del presupuesto debe ser numérico',
		'costos_directos.numeric' => 'El valor de los costos directos debe ser numérico',
		'gastos_generales.numeric' => 'El valor de los costos generales debe ser numérico',
		'fecha_licitacion.required' => 'Debe indicar la fecha de licitación en formato dd/mm/yyyy',
		'ide.required' => 'Debe indicar el ID de proyecto',
		'tipo_proyecto.required' => 'Debe indicar tipo de proyecto, ej: Pavimento Participativo',
		'activo.required' =>'Debe indicar si se encuentra activa esta licitación',

	);


        $validator = Validator::make($data, $rules, $mensajes);

        if ($validator->passes())
        {

            return true;
        }

        $this->errors = $validator->errors();
	return false;
        }
	

	public function empresa(){

//		return $this->belongsToMany('App\Models\Empresa', 'proyecto_contratista', 'id_empresa', 'id_proyecto');
		return $this->belongsTo('App\Models\Empresa', 'id_empresa', 'id');

	}

	public function proyectocontratista(){

                return $this->hasMany('App\Models\Proyectocontratista');
        }

	public function comuna(){

		return $this->belongsTo('App\Models\Comuna', 'id_comuna', 'id');	
	}

	public function partida(){

		return $this->hasMany('App\Models\Partida');
	}
	
	public function trabajador(){

                return $this->belongsToMany('App\Models\Trabajador', 'proyecto_trabajador', 'id_trabajador', 'id_proyecto');
        }



	public static function boot()
    	{
        parent::boot();    
    
        
        static::deleted(function($proyecto)
        {
        	//if(!empty($proyecto->partida())){
        	//	$proyecto->partida()->delete(); /*borra la partida también*/
        	//}
        	//else{
        		$proyecto->delete();

        	//}
           
            
        });
    }    

}

