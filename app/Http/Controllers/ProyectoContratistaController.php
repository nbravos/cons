<?php

use \App\Models\Proyectocontratista;
use \App\Models\Empresa;
use \App\Models\Proyecto;

class ProyectoContratistaController extends Controller
{
     public function create($id)
        {

			
			$proyecto = DB::select(DB::raw("SELECT * FROM proyecto WHERE id = '$id'"));
			$proy = Proyecto::find($id);
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
     $data['fecha_oferta'] = date('Y-m-d', strtotime($data['fecha_oferta']));

	
//	if($pc->isValid($data))
//	{
	 

/*	 $pc->id_empresa =  Input::get('id_empresa');
	 $pc->id_proyecto = Input::get('id_proyecto');

	 $pc->monto_ofertado =  Input::get('monto_ofertado');
	 $pc->dias =  Input::get('dias');*/
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


	public function verOfertasProyecto($id){

		  
        $ofertas = DB::table('proyecto_contratista')
                                ->join('empresa', 'empresa.id', '=', 'proyecto_contratista.id_empresa')
        			->join('proyecto', function($join) use ($id) {
        				$join->on('proyecto.id', '=', 'proyecto_contratista.id_proyecto')
        				->where('proyecto_contratista.id_proyecto', '=', $id);
        			})
        			->select(['proyecto_contratista.id', 'empresa.nombre as mand', 'proyecto_contratista.monto_ofertado as montOf',  'proyecto_contratista.dias as diasOf']);
        			if(request()->ajax()){
        				return Datatables::of($ofertas)
				->addColumn('action', function ($oferta) {
                		return '<a href="/ofertas/'.$oferta->id.'" class="btn btn-info"> Ver</a>';		                
              				  })
                
        				->make(true);

        				};
        		 //return View::make('site/proyectos/show');

        			}

    public function verOfertasEmpresa($id){

         $ofertas = DB::table('proyecto_contratista')
                                ->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
                    ->join('empresa', function($join) use ($id) {
                        $join->on('empresa.id', '=', 'proyecto_contratista.id_empresa')
                        ->where('proyecto_contratista.id_empresa', '=', $id);
                    })
                    ->select(['proyecto_contratista.id', 'empresa.nombre as mand', 'proyecto.nombre as proNom', 'proyecto_contratista.monto_ofertado as montOf',  'proyecto_contratista.dias as diasOf']);
                    if(request()->ajax()){
                        return Datatables::of($ofertas)
                ->addColumn('action', function ($oferta) {
                        return '<a href="/ofertas/'.$oferta->id.'" class="btn btn-info"> Ver</a>';                      
                              })
                
                        ->make(true);

                        };
       if($id == 0) {
         $ofertas = DB::table('proyecto_contratista')
                                ->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
                    ->join('empresa', function($join) use ($id) {
                        $join->on('empresa.id', '=', 'proyecto_contratista.id_empresa')
                        ->where('proyecto_contratista.id_empresa', '=', $id);
                    })
                    ->select(['proyecto_contratista.id', 'empresa.nombre as mand', 'proyecto.nombre as proNom', 'proyecto_contratista.monto_ofertado as montOf',  'proyecto_contratista.dias as diasOf'])
                    ->where('proyecto_contratista.estado_oferta', '=', 0);

                    if(request()->ajax()){
                        return Datatables::of($ofertas)
                ->addColumn('action', function ($oferta) {
                        return '<a href="/ofertas/'.$oferta->id.'" class="btn btn-info"> Ver</a>';                      
                              })
                
                        ->make(true);

            }
        }

        if($id == 1)
        {
             $ofertas = DB::table('proyecto_contratista')
                                ->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
                    ->join('empresa', function($join) use ($id) {
                        $join->on('empresa.id', '=', 'proyecto_contratista.id_empresa')
                        ->where('proyecto_contratista.id_empresa', '=', $id);
                    })
                    ->select(['proyecto_contratista.id', 'empresa.nombre as mand', 'proyecto.nombre as proNom', 'proyecto_contratista.monto_ofertado as montOf',  'proyecto_contratista.dias as diasOf'])
                    ->where('proyecto_contratista.estado_oferta', '=', 1);

                    if(request()->ajax()){
                        return Datatables::of($ofertas)
                ->addColumn('action', function ($oferta) {
                        return '<a href="/ofertas/'.$oferta->id.'" class="btn btn-info"> Ver</a>';                      
                              })
                
                        ->make(true);
            }
        
        }

        if($id == 2)
        {
            $ofertas = DB::table('proyecto_contratista')
                                ->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
                    ->join('empresa', function($join) use ($id) {
                        $join->on('empresa.id', '=', 'proyecto_contratista.id_empresa')
                        ->where('proyecto_contratista.id_empresa', '=', $id);
                    })
                    ->select(['proyecto_contratista.id', 'empresa.nombre as mand', 'proyecto.nombre as proNom','proyecto_contratista.monto_ofertado as montOf',  'proyecto_contratista.dias as diasOf'])
                    ->where('proyecto_contratista.estado_oferta', '=', 2);

                    if(request()->ajax()){
                        return Datatables::of($ofertas)
                ->addColumn('action', function ($oferta) {
                        return '<a href="/ofertas/'.$oferta->id.'" class="btn btn-info"> Ver</a>';                      
                              })
                
                        ->make(true);
                    }


        }     
        }     

  
public function filtroFecha($from, $to, $id){


           $ofertas = DB::table('proyecto_contratista')
                                ->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
                    ->join('empresa', function($join) use ($id) {
                        $join->on('empresa.id', '=', 'proyecto_contratista.id_empresa')
                        ->where('proyecto_contratista.id_empresa', '=', $id);
                    })
                    ->select(['proyecto_contratista.id', 'empresa.nombre as mand', 'proyecto.nombre as proNom', 'proyecto_contratista.monto_ofertado as montOf',  'proyecto_contratista.dias as diasOf'])
                    ->whereBetween('fecha_oferta', [$from, $to]);
        
          if(request()->ajax()){
                        return Datatables::of($ofertas)
                ->addColumn('action', function ($oferta) {
                        return '<a href="/ofertas/'.$oferta->id.'" class="btn btn-info"> Ver</a>';                      
                              })
                
                        ->make(true);
        }
}


public function show($id)
    {
        $pc = Proyectocontratista::find($id);
         if (is_null ($pc))
                {
                        App::abort(404)->with('message', 'Oferta no encontrada');
                }
//        dd($proyecto);
                return View::make('site/proyectocontratista/show', array('pc' => $pc));
    }

public function edit($id){
    $pc = Proyectocontratista::find($id);
    if (is_null ($pc))
        {
            App::abort(404);
        }
        return View::make('site/proyectocontratista/edit')->with('pc' ,$pc);

}

public function update($id){
    $oferta = Proyectocontratista::find($id);
    if (is_null ($oferta))
        {
            App::abort(404);
        }
    $data =  Input::all();

    $oferta->fill($data);
    $oferta->save();

    return Redirect::route('proyectos.index');



}

public function destroy($id)
	{
		$oferta = Proyectocontratista::find($id);
        
	        if (is_null ($oferta))
        	{
        	    App::abort(404);
        	}
        	$oferta->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Oferta  eliminada',
                        'id'      => $oferta->id
            	));
        	}
        	else
       		{
	            return Redirect::route('proyectos.index');
        	}
	}
}
