<?php

use \App\Models\Proyectocontratista;
use \App\Models\Empresa;
use \App\Models\Proyecto;

class ProyectoContratistaController extends Controller
{
     public function create($id)
        {

			
			$proyecto = DB::select(DB::raw("SELECT * FROM proyecto WHERE id = '$id'"));
                        $empresas = Empresa::pluck('nombre', 'id');                      
//			dd($proyecto["0"]->nombre);
                        return View::make('site/proyectocontratista/form')
                                        ->with('empresas', $empresas)
					->with('proyecto', $proyecto);
					
                                        

        }
	

    public function store()
	{
	 $pc = new Proyectocontratista;
	 $data =  Input::all(); 
	
//	if($pc->isValid($data))
//	{
/*	 $pc->id_empresa =  Input::get('id_empresa');
	 $pc->id_proyecto = Input::get('id_proyecto');
	 $pc->monto_ofertado =  Input::get('monto_ofertado');
	 $pc->bases =  Input::get('bases');*/
	 $pc->fill($data);
//	dd($pc);
	 $pc->save();
	 
	 return Redirect::route('proyectos.index');

//	}
	
/*	else 
	{
		return Redirect::route('addof', ['id' => $pc->id_proyecto])->withInput()->withErrors($pc->errors);
		
	}*/
}
}
