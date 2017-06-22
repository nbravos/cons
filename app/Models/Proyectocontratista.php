<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Validator;



class Proyectocontratista extends Model
{
    protected $fillable = ['id_proyecto', 'id_empresa', 'monto_ofertado', 'dias', 'estado_oferta'];

    protected $table ='proyecto_contratista';
    public $errors;
    public $timestamps = false;



	public function isValid($data)
                {
                        $rules = array(

                        'id_proyecto' => 'required|',
                        'id_empresa' => 'required|',
                        'monto_ofertado' => 'required',
			             'dias' => 'required',
                         'estado_oferta' => 'required',
                        
                        );
        $mensajes = array (
                'id_empresa.required' => 'El campo empresa es obligatorio',
                'dias.required' => 'Debe indicar las dias del proyecto',
                'monto_ofertado.numeric' => 'El valor debe ser numérico',
                'estado_oferta.required' => 'Debe indicar si la oferta fue ganadora',
        );


 	        $validator = Validator::make($data, $rules, $mensajes);
		}

	public function proyecto(){

                return $this->belongsTo('App\Models\Proyecto', 'id_proyecto', 'id');
        }


	public function empresa(){

                return $this->belongsTo('App\Models\Empresa', 'id_empresa', 'id');
        }

}

