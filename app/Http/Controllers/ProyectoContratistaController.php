<?php


use \App\Models\Empresa;
use \App\Models\Proyecto;

class ProyectoContratistaController extends Controller
{
     public function create($proyectoid)
        {
                        $empresa = Empresa::pluck('nombre', 'id');
                       

                        return View::make('site/proyectocontratista/form')
                                        ->with('empresa', $empresa)
					->with('id_proyecto', $proyectoid);
					
                                        

        }
	

    public function store($proyectoid)
	{
	 $pc = new Proyectocontratista;
	 $data =  Input::all();


	if($oc->isValid($data))
	{
	 $pc->id_empresa =  Input::get('id_empresa');
	 $pc->id_proyecto = Input::get('id_proyecto');
	 $pc->monto_ofertado =  Input::get('monto_ofertado');
	 $pc->bases =  Input::get('bases');
	 $pc->fill($data);
	 $pc->save();
	 
	 return Redirect::route('proyectos.index');

	}
	
	else 
	{
		return Redirect::route('ofertas.create')->withInput()->withErrors($oc->errors);
		
	}
}
}
