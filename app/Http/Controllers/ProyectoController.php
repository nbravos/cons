<?php

use \App\Models\Proyecto;
use \App\Models\Empresa;
use \App\Models\Comuna;
use \App\Models\Partida;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;


class ProyectoController extends \BaseController {

/**
	 * Display a listing of the resource.
	 * GET /trabajador
	 *
	 * @return Response
	 */
	public function index()

	{
		   					
		  $proyectos = DB::table('proyecto')
					->join('comuna', 'comuna.id', '=','proyecto.id_comuna')
					->join('empresa', 'empresa.id', '=','proyecto.id_empresa')
					
	->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand' ,'proyecto.fecha_licitacion'])->where([['proyecto.id_comuna', '=', '5101'], ['proyecto.id_empresa', '=', '8']]);
		
		if (request()->ajax()){
		                return Datatables::of($proyectos)

		->addColumn('action', function ($proyecto) {
                return '<a href="/proyectos/'.$proyecto->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')

        ->editColumn('fecha_licitacion', function ($proyecto) {
		        return $proyecto->fecha_licitacion ? with(new Carbon($proyecto->fecha_licitacion))->format('d-m-Y') : '';
			//return $proyecto->fecha_licitacion->format('d-m-Y');
			
            })
            ->filterColumn('proyecto.fecha_licitacion', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(proyecto.fecha_licitacion,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })

            ->make(true);
        }
        return View::make('site/proyectos/list')/*->with('comuna', $comuna)
	        						->with('proyectos', $proyectos)*/;  
	}	        						
	    	

	/**
	 * Show the form for creating a new resource.
	 * GET /trabajador/create
	 *
	 * @return Response
	 */
	public function create()
	{
			$empresa = Empresa::pluck('nombre', 'id');
			$comuna = Comuna::orderBy('nombre', 'asc')->pluck('nombre', 'id');

			return View::make('site/proyectos/form')
					->with('empresa', $empresa)
					->with('comuna', $comuna);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /proyecto
	 *
	 * @return Response
	 */
	public function store()
	{
		$proyecto = new Proyecto;
                
		$data = Input::all();
        //	dd($data);
	
		if($proyecto->isValid($data))
		{
			$fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha_licitacion']);
			$data['fecha_licitacion'] = $fecha1->format("Y-m-d h:i:s");
 		    $proyecto->fill($data);
		    $proyecto->save();	           
		    return Redirect::route('proyectos.index'); 

		}
		else
		{
			return Redirect::route('proyectos.create')->withInput()->withErrors($proyecto->errors);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /proyecto/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$proyecto = Proyecto::find($id);
		 if (is_null ($proyecto))
                {
                        App::abort(404)->with('message', 'Proyecto no encontrado');
                }
		//dd($proyecto);
                return View::make('site/proyectos/show', array('proyecto' => $proyecto));
	}

	public function activarProy($id_proyecto)
    	{
        	$proyecto = Proyecto::find($id_proyecto);
	        $proyecto->activo = 1;
		$proyecto->save();
                return View::make('site/proyectos/show', array('proyecto' => $proyecto));
    	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /trabajador/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$proyecto = Proyecto::find($id);
		if (is_null ($proyecto))
		{
			App::abort(404);
		}
	
	$empresa = Empresa::pluck('nombre', 'id');
        $comuna = Comuna::pluck('nombre', 'id');
        return View::make('site/proyectos/edit')->with('proyecto', $proyecto)
						->with('empresa', $empresa)
                                        	->with('comuna', $comuna);
;
	
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /trabajador/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$proyecto = Proyecto::find($id);
        
     	if (is_null ($proyecto))
        {
            App::abort(404);
        }
        
        $data = Input::all();
	//dd($data);

        
        if ($proyecto->isValid($data))
        {
	//dd($data);
        $fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha_licitacion']);
	$data['fecha_licitacion'] = $fecha1->format("Y-m-d h:i:s");
	   // dd($data);
            $proyecto->fill($data);
           
            $proyecto->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('proyectos.index');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('proyectos.edit', $proyecto->id)->withInput()->withErrors($proyecto->errors);
        }

	}

	public function filtroFecha($from, $to){


		  $proyectos = DB::table('proyecto')
					->join('comuna', 'comuna.id', '=','proyecto.id_comuna')
					->join('empresa', 'empresa.id', '=','proyecto.id_empresa')
					->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand' ,'proyecto.fecha_licitacion'])
					->whereBetween('fecha_licitacion', [$from, $to]);
		
		if (request()->ajax()){
		                return Datatables::of($proyectos)

		->addColumn('action', function ($proyecto) {
                return '<a href="/proyectos/'.$proyecto->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')

        ->editColumn('fecha_licitacion', function ($proyecto) {
		        return $proyecto->fecha_licitacion ? with(new Carbon($proyecto->fecha_licitacion))->format('d-m-Y') : '';
			//return $proyecto->fecha_licitacion->format('d-m-Y');
			
            })
            ->filterColumn('proyecto.fecha_licitacion', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(proyecto.fecha_licitacion,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })

            ->make(true);
        }
}

	public function filtroComuna($id){
		if($id == 0){

				 					
		  $proyectos = DB::table('proyecto')
					->join('comuna', 'comuna.id', '=','proyecto.id_comuna')
					->join('empresa', 'empresa.id', '=','proyecto.id_empresa')
	->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand' ,'proyecto.fecha_licitacion']);
		
		if (request()->ajax()){
		                return Datatables::of($proyectos)

		->addColumn('action', function ($proyecto) {
                return '<a href="/proyectos/'.$proyecto->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')

        ->editColumn('fecha_licitacion', function ($proyecto) {
		        return $proyecto->fecha_licitacion ? with(new Carbon($proyecto->fecha_licitacion))->format('d-m-Y') : '';
			//return $proyecto->fecha_licitacion->format('d-m-Y');
			
            })
            ->filterColumn('proyecto.fecha_licitacion', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(proyecto.fecha_licitacion,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })

            ->make(true);
        }
        

		}
		else 
		{
		$proyectos = DB::table('proyecto')
					->join('empresa', 'empresa.id', '=','proyecto.id_empresa')
					->join('comuna', function($join) use ($id) {
        				$join->on('comuna.id', '=', 'proyecto.id_comuna')
        				->where('proyecto.id_comuna', '=', $id);
        			})
					->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand' ,'proyecto.fecha_licitacion']);
		if(request()->ajax()){
        			return Datatables::of($proyectos)
        			->addColumn('action', function ($proyecto) {
                return '<a href="/proyectos/'.$proyecto->id.'" class="btn btn-info"> Ver</a>';		                
                })

		->editColumn('fecha_licitacion', function ($proyecto) {
		        return $proyecto->fecha_licitacion ? with(new Carbon($proyecto->fecha_licitacion))->format('d-m-Y') : '';			
            })
			
        			->make(true);
        			};
		}
		



	}

	public function filtroMandante($id){
		if($id == 0){
			$proyectos = DB::table('proyecto')
					->join('comuna', 'comuna.id', '=','proyecto.id_comuna')
					->join('empresa', 'empresa.id', '=','proyecto.id_empresa')
	->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand' ,'proyecto.fecha_licitacion']);
		
		if (request()->ajax()){
		                return Datatables::of($proyectos)

		->addColumn('action', function ($proyecto) {
                return '<a href="/proyectos/'.$proyecto->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')

        ->editColumn('fecha_licitacion', function ($proyecto) {
		        return $proyecto->fecha_licitacion ? with(new Carbon($proyecto->fecha_licitacion))->format('d-m-Y') : '';
			//return $proyecto->fecha_licitacion->format('d-m-Y');
			
            })
            ->filterColumn('proyecto.fecha_licitacion', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(proyecto.fecha_licitacion,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })

            ->make(true);
        }


		}
		else {


		$proyectos = DB::table('proyecto')
					->join('comuna', 'comuna.id', '=','proyecto.id_comuna')
					->join('empresa', function($join) use ($id) {
        				$join->on('empresa.id', '=', 'proyecto.id_empresa')
        				->where('proyecto.id_empresa', '=', $id);
        			})
					->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand' ,'proyecto.fecha_licitacion']);
		if(request()->ajax()){
        			return Datatables::of($proyectos)
        			->addColumn('action', function ($proyecto) {
                return '<a href="/proyectos/'.$proyecto->id.'" class="btn btn-info"> Ver</a>';		                
                })
		
		->editColumn('fecha_licitacion', function ($proyecto) {
		        return $proyecto->fecha_licitacion ? with(new Carbon($proyecto->fecha_licitacion))->format('d-m-Y') : '';			
            })
			
        			->make(true);
        			};


	}
}



	/**
	 * Remove the specified resource from storage.
	 * DELETE /trabajador/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$proyecto = Proyecto::find($id);
        
	        if (is_null ($proyecto))
        	{
        	    App::abort(404);
        	}
        	$proyecto->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Proyecto ' . $proyecto->nombre . ' eliminado',
                        'id'      => $proyecto->id
            	));
        	}
        	else
       		{
	            return Redirect::route('proyectos.index');
        	}
	}

	public function filtroProyecto()
	{

		$proy = Proyecto::all()->sortBy("nombre");
		

	}

}
