<?php

use App\Models\Proyecto; 
use App\Models\Partida;
use App\Models\Avance;
use App\Models\Trabajador;
use Carbon\Carbon;

class PartidaController extends \Controller {

	/**
	 * Display a listing of the resource.
	 * GET /partida
	 *
	 * @return Response
	 */

	public function index()
	{
		
/* NO CARGA LA TABLA INMEDIATAMENTE, SE USA INDEX 2
		 $partidas = DB::table('partida')->join('proyecto', 'proyecto.id', '=', 'partida.id_proyecto')->select(['partida.id','partida.nombre as partNombre','partida.item', 'partida.total', 'partida.activa']);
		if (request()->ajax()){
		                return Datatables::of($partidas)

		->addColumn('action', function ($partida) {
                return '<a href="/partidas/'.$partida->id.'" class="btn btn-info">Ver</a>';		                
                })
		//->editColumn('inicio_real', function ($partida) {
		        //return $partida->inicio_real ? with(new Carbon($partida->inicio_real))->format('d-m-Y') : '';
			
            //})
            //F
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        } 

*/
	    return View::make('site/partidas/list');//->with('partidas', $partidas);
	    								
	}

  /*NO SE UTILIZA*/
	/*public function dropProyectos($id){ 
		if ($id == 0){ //todos
			$proyectos = DB::table('proyecto')->select('nombre', 'id')->where('estado', '=', 'ganado')->get();
		}
		if ($id == 1) { //proyectos activos
			$proyectos = DB::table('proyecto')->select('nombre', 'id')->where([['activo', '=', '1'], ['estado', '=', 'ganado']])->get();
		}
		if ($id == 2) { //proy no activos
			$proyectos = DB::table('proyecto')->select('nombre', 'id')->where([['activo', '=', '2'], ['estado', '=', 'ganado']])->get();
		} 

		return response()->json($proyectos);
	}*/

    public function index2($id)
    {

/*INDEX ANTERIOR*/
    	/* $partidas = DB::table('partida')
    	 ->join('proyecto', function($join) use ($id){
    	 	$join->on('proyecto.id', '=', 'partida.id_proyecto')
                        ->where('partida.id_proyecto', '=', $id);

    	 })
    	
    	 ->select(['partida.id','partida.nombre as partNombre', 'partida.item', 'partida.total', 'partida.unidad', 'partida.cantidad','partida.activa']);

		if (request()->ajax()){
		                return Datatables::of($partidas)

		->addColumn('action', function ($partida) {
                return '<a href="/partidas/'.$partida->id.'" class="btn btn-info">Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        } */
        
       if($id == 0) {
       	$obras = DB::table('proyecto')
        ->join('comuna', 'comuna.id', '=', 'proyecto.id_comuna')
        ->join('empresa', 'empresa.id', '=', 'proyecto.id_empresa')
        ->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand', 'proyecto.fecha_licitacion as fecha_licitacion'])
       	->where('estado', '=', 'ganado');
       	if (request()->ajax()){
		                return Datatables::of($obras)

		->addColumn('action', function ($obra) {
                return '<a href="/partidas/obra/'.$obra->id.'" class="btn btn-info">Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);

       }
   }

       if($id == 1){
       	$obras = DB::table('proyecto')
        ->join('comuna', 'comuna.id', '=', 'proyecto.id_comuna')
        ->join('empresa', 'empresa.id', '=', 'proyecto.id_empresa')
        ->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand', 'proyecto.fecha_licitacion as fecha_licitacion'])
        ->where([['activo', '=', '1'], ['estado', '=', 'ganado']]);
        if (request()->ajax()){
		                return Datatables::of($obras)

		->addColumn('action', function ($obra) {
                return '<a href="/partidas/obra/'.$obra->id.'" class="btn btn-info">Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);

       }
   }
       if($id == 2){
       		$obras = DB::table('proyecto')
        ->join('comuna', 'comuna.id', '=', 'proyecto.id_comuna')
        ->join('empresa', 'empresa.id', '=', 'proyecto.id_empresa')
        ->select(['proyecto.id', 'proyecto.nombre as proNombre', 'comuna.nombre as comu', 'empresa.nombre as mand', 'proyecto.fecha_licitacion as fecha_licitacion'])
        ->where([['activo', '=', '2'], ['estado', '=', 'ganado']]);
        if (request()->ajax()){
		                return Datatables::of($obras)

		->addColumn('action', function ($obra) {
                return '<a href="/partidas/obra/'.$obra->id.'" class="btn btn-info">Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);

       }
        
    }
}

	//Route::get('partidas/obra/{id}', ['uses' => 'PartidaController@vistaObra'])->name('getObra');
	public function vistaObra($id) {
		$proyecto = Proyecto::find($id);
		 if (is_null ($proyecto))
                {
                        App::abort(404)->with('message', 'Obra no encontrada');
                }
		//dd($proyecto);
                return View::make('site/partidas/obra', array('proyecto' => $proyecto));

	}

	//carga agregar trabajador
	public function addTrabajadorObra($id){

        $trabajadores = Trabajador::all();
        $proyecto = Proyecto::find($id);
        return View::make('site/partidas/addtrabajador')
         ->with('proyecto', $proyecto)
         ->with('trabajadores', $trabajadores);

	}

	public function storeTrabajadorObra($id){

		$data = Input::all();
		$proy = Proyecto::find($id);
		$fecha = DateTime::createFromFormat('d/m/Y', $data['fecha']);
        $data['fecha'] = $fecha->format("Y-m-d h:i:s");
        $trabajadores = $data['trabajadores'];
        $fecha = $data['fecha'];
                foreach ($trabajadores as $trabajador) {
                $id_trabajador = $trabajador;
                $fecha = $data['fecha'];
                $proy->trabajador()->attach([$proy->id => ['fecha' => $fecha, 'id_trabajador' => $trabajador ]]);

                }
                
return Redirect::route('getObra', $proy->id);
//	return redirect()->back();
      


	}

	public function index3($id){

		$partidas = DB::table('partida')
    	 ->join('proyecto', function($join) use ($id){
    	 	$join->on('proyecto.id', '=', 'partida.id_proyecto')
                        ->where('partida.id_proyecto', '=', $id);

    	 })
    	
    	 ->select(['partida.id','partida.nombre as partNombre', 'partida.item', 'partida.total', 'partida.unidad', 'partida.cantidad','partida.activa']);

		if (request()->ajax()){
		                return Datatables::of($partidas)

		->addColumn('action', function ($partida) {
                return '<a href="/partidas/'.$partida->id.'" class="btn btn-xs btn-primary">Ver</a> <a href="/partidas/'.$partida->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';	            
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        }

	}
	
	public function getTablaAsistencia($id){
		$asiste = DB::table('asistencia')
				->join('trabajador', 'trabajador.id', '=', 'asistencia.id_trabajador')
				->join('proyecto_trabajador', function($join) use ($id) {
        				$join->on('proyecto_trabajador.id_trabajador', '=', 'trabajador.id')
        				->where('proyecto_trabajador.id_proyecto', '=', $id);
        			})
				/*->join('partida', function($join) use ($id) {
        				$join->on('partida.id_proyecto', '=', 'proyecto_trabajador.id_proyecto')
        				->where('partida.id_proyecto', '=', $id);
        			})*/
				->join('usuario', 'usuario.id', '=', 'asistencia.id_usuario')
				->select('asistencia.fecha', 'asistencia.presente', 'trabajador.nombre', 'trabajador.ap_paterno', 'usuario.name');
				if(request()->ajax()){
					return Datatables::of($asiste)
					
					
					->make(true);
				}
			
		$obra = Proyecto::find($id);
		$trabajadores = DB::table('trabajador')
    					->join('proyecto_trabajador', function($join) use ($id){
    						$join->on('proyecto_trabajador.id_trabajador', '=', 'trabajador.id')
    						->where('proyecto_trabajador.id_proyecto', '=', $id);
    					})
    					->select('trabajador.nombre', 'trabajador.ap_paterno', 'trabajador.id')->get();
		
		                
		
		return View::make('site/partidas/asistencia_multifilter')->with('asiste', $asiste)->with('obra', $obra)->with('trabajadores', $trabajadores);
		}
	
	/**
	 * Show the form for creating a new resource.
	 * GET /partida/create
	 *
	 * @return Response
	 */
	public function create()
	{

        $proyectos = Proyecto::pluck('nombre', 'id');		
		//dd($proyectos);
		return View::make('site/partidas/form', ['proyectos' => $proyectos]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /partida
	 *
	 * @return Response
	 */
	public function store()
	{
		$partida = new Partida;
		
		$data = Input::all();
        //	dd($data);

		if($partida->isValid($data))
		{

		    $fecha1 = DateTime::createFromFormat('d-m-Y', $data['inicio_teorico']);
            $fecha2 = DateTime::createFromFormat('d-m-Y', $data['fin_teorico']);
            $fecha3 = DateTime::createFromFormat('d-m-Y', $data['inicio_real']);
            $fecha4 = DateTime::createFromFormat('d-m-Y', $data['fin_real']);
		    $data['inicio_teorico'] = $fecha1->format("Y-m-d H:i:s");
		    $data['fin_teorico'] = $fecha2->format("Y-m-d H:i:s");
		    if (!empty($data['inicio_real'])) {
		    	$data['inicio_real'] = $fecha3->format("Y-m-d H:i:s");

		    }
		    	if (!empty($data['fin_real'])){
		    		$data['fin_real'] = $fecha4->format("Y-m-d H:i:s");
		    }

		    $idProyecto = Proyecto::find($data['id_proyecto']);	
		    if(!empty($idProyecto->presupuesto_oficial)){
		    	$presupuesto = $idProyecto->presupuesto_oficial;
           		$data['total'] = $data['unitario']*$data['cantidad'];
		    	$data['porcentaje'] = ($data['total'])/($idProyecto->presupuesto_oficial);
		    } 
		    else{
		    	$presupuesto = 1;
		    	$data['total'] = $data['unitario']*$data['cantidad'];
		    	$data['porcentaje'] = ($data['total'])/($presupuesto);
		    }	
		    	 	    
 		    $partida->fill($data);
		    $partida->save();	           
		//dd($partida->inicio_teorico);
		    
		    return Redirect::route('partidas.index'); 

		}
		else
		{
			return Redirect::route('partidas.create')->withInput()->withErrors($partida->errors);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /partida/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$partida = Partida::find($id);
		//dd($partida->avance[0]->fecha_termino);	
		 if (is_null ($partida))
                {
                        App::abort(404)->with('message', 'Partida no encontrada');
                }
                return View::make('site/partidas/show', array('partida' => $partida));
	
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /partida/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$partida = Partida::find($id);
		if (is_null ($partida))
		{
			App::abort(404);
		}
        $proyectos = Proyecto::pluck('nombre','id');
        return View::make('site/partidas/edit')->with('partida', $partida)
					->with('proyectos', $proyectos);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /partida/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$partida = Partida::find($id);
        
     	if (is_null ($partida))
        {
            App::abort(404);
        }
        
        $data = Input::all();
	//dd($data);
        if ($partida->isValid($data))
        {
		
	    	$fecha1 = DateTime::createFromFormat('d-m-Y', $data['inicio_teorico']);
            $fecha2 = DateTime::createFromFormat('d-m-Y', $data['fin_teorico']);
           
		    $data['inicio_teorico'] = $fecha1->format("Y-m-d H:i:s");
		    $data['fin_teorico'] = $fecha2->format("Y-m-d H:i:s");

		    if (!empty($data['inicio_real'])) {
		    	 $fecha3 = DateTime::createFromFormat('d-m-Y', $data['inicio_real']);
		    	$data['inicio_real'] = $fecha3->format("Y-m-d H:i:s");

		    }
		    	if (!empty($data['fin_real'])){
		    		$fecha4 = DateTime::createFromFormat('d-m-Y', $data['fin_real']);
		    		$data['fin_real'] = $fecha4->format("Y-m-d H:i:s");
		    }
            $partida->fill($data);
           
            $partida->save();
            return Redirect::route('partidas.index');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('partidas.edit', $partida->id)->withInput()->withErrors($partida->errors);
        }
	}

	public function verPartProyecto($id){
	
		      $proy = Proyecto::find($id);
        $partidas = DB::table('partida')
        			->join('proyecto', function($join) use ($id) {
        				$join->on('proyecto.id', '=', 'partida.id_proyecto')
        				->where('partida.id_proyecto', '=', $id);
        			})
        			->select(['partida.id','partida.nombre as partNombre', 'detalle', 'inicio_real']);
        			if(request()->ajax()){
        				return Datatables::of($partidas)
				 ->editColumn('inicio_real', function ($partida) {
                        return $partida->inicio_real ? with(new Carbon($partida->inicio_real))->format('d-m-Y') : '';
					})
        				->make(true);

        				};
        		 return View::make('site/partidas/proy')->with('proy', $proy);

        			}
        			//->whereIn('users.id', $values)
   public function asistenciaDiaria($id){

    	$trabajadores = DB::table('proyecto_trabajador')->select('id_trabajador')->where('id_proyecto', '=', $id);
    	$asistencias = DB::table('asistencia')
    				->join('trabajador', 'trabajador.id', '=', 'id_trabajador')
    				->join('usuario', 'usuario.id', '=', 'id_usuario')
    				->select('asistencia.presente', 'asistencia.fecha', 'trabajador.nombre', 'trabajador.ap_paterno', 'usuario.name')
    				->whereIn('asistencia.id_trabajador', $trabajadores);
	                
			
    				if(request()->ajax()){
        				return Datatables::of($asistencias)
					->editColumn('fecha', function ($asistencia) {
		        return $asistencia->fecha ? with(new Carbon($asistencia->fecha))->format('d-m-Y') : '';
		        })
        				->make(true);

        				};
    		}   

    public function graficoAsistenciaDiaria($id_trabajador, $id_obra){

		$desde = Carbon::now()->subDay(5)->startOfWeek()->toDateString();
		$hasta = Carbon::now()->subDay(1)->toDateString();
		
		$partidas = DB::table('partida')
				->where(function ($query) use ($id_obra) {
    					$query->where('id_proyecto', '=', $id_obra);
						})
				->pluck('id');			
		
		
		$asistencia = DB::table('asistencia')
					->join('trabajador', 'trabajador.id', '=', 'asistencia.id_trabajador')
					->where(function ($query) use ($id_trabajador) {
    					$query->where('trabajador.id', '=', $id_trabajador);
						})
					->join('asistencia_partida', 'asistencia_partida.id_asistencia', '=', 'asistencia.id')
					->whereIn('asistencia_partida.id_partida', $partidas)
					->whereBetween('asistencia.fecha', [$desde, $hasta])
					->select('asistencia.fecha as fecha', 'trabajador.nombre as nombre', 'trabajador.ap_paterno as apellido', 'asistencia.presente as presente')->get();
					
					//return $asistencia;
					return(json_encode($asistencia));

    }


  				

	/**
	 * Remove the specified resource from storage.
	 * DELETE /partida/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$partida = Partida::find($id);
        
	        if (is_null ($partida))
        	{
        	    App::abort(404);
        	}
        	$partida->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Partida ' . $partida->nombre . ' eliminada',
                        'id'      => $partida->id
            	));
        	}
        	else
       		{
	            return Redirect::route('partidas.index');
        	}
	}

}
