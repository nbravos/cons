<?php


use App\Models\Equipo;
use App\Models\Proyecto;
use Yajra\Datatables\Datatables;

class EquipoController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /equipo
	 *
	 * @return Response
	 */
	public function index()
	{

	/*$equipos = DB::table('equipo')
	    	->join('proyecto_equipo', 'id', '=', 'id_equipo')
	    	->join('proyecto', function ($join) {
            	$join->on('proyecto.id', '=', 'proyecto_equipo.id_proyecto');
	        })
	    	->select('equipo.id', 'equipo.nombre', 'equipo.descripcion', 'proyecto.nombre');*/
	    $equipos = Equipo::select('equipo.id', 'equipo.nombre as nombre', 'equipo.descripcion as descripcion', 'proyecto.nombre as obra')
	    	->join('proyecto_equipo', 'proyecto_equipo.id_equipo', '=', 'equipo.id')
            ->join('proyecto', function($join){
                $join->on('proyecto.id','=','proyecto_equipo.id_proyecto');
            })
            ->get();
		if (request()->ajax()){
		                return Datatables::of($equipos)

		->addColumn('action', function ($equipo) {
                return '<a href="/equipos/'.$equipo->id.'" class="btn btn-info"> Ver</a>';		                
	})
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        }
	     //   $ubicaciones = DB::table('posicion_equipo')->get();
             $ubicaciones = DB::table('posicion_equipo')->join('equipo', function ($join) {
            $join->on('posicion_equipo.imei', '=', 'equipo.codigo');
        })->get(array('posicion_equipo.id', 'imei', 'lat', 'lon', 'fecha', 'equipo.nombre'));

//	return View::make('site/equipos/list', compact('ubicaciones'))->with('equipos', $equipos);
        	return View::make('site/equipos/list', compact('ubicaciones', 'equipos'));


		}

	/**
	 * Show the form for creating a new resource.
	 * GET /equipo/create
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$proyectos = Proyecto::pluck('nombre', 'id');		

		return View::make('site/equipos/form',  ['proyectos' => $proyectos]);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /equipo
	 *
	 * @return Response
	 */
	public function store()
	{
		$equipo = new Equipo;

		//Se obtiene la data del usuario
		$data = Input::all();
		

		//Comprueba que sea válido
		if($equipo->isValid($data))
		{
	            $equipo->fill($data);
		    $equipo->save();    
		    return Redirect::route('equipos.index'); 

		}
		else
		{
			//Si no se valida redirige a create con los errores qeu se encontraron
			return Redirect::route('equipos.create')->withInput()->withErrors($equipo->errors);; 
		}		
	}

	/**
	 * Display the specified resource.
	 * GET /equipo/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		 $equipo = Equipo::find($id);
		 if (is_null ($equipo))
          {
            App::abort(404)->with('message', 'Equipo no encontrado');
          }
            return View::make('site/equipos/show', array('equipo' => $equipo));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /equipo/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$equipo = Equipo::find($id);
		

        return View::make('site/equipos/form')->with('equipo', $equipo);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /equipo/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$equipo = Equipo::find($id);
        
     	if (is_null ($equipo))
        {
            App::abort(404);
        }
        
        $data = Input::all();


        if ($equipo->isValid($data))
        {
            $equipo->fill($data);
           
            $equipo->save();
            return Redirect::route('equipos.index');
        }
        else
        {
	    dd($data);
            return Redirect::route('equipos.edit')->withUser($equipo->$id)->withErrors($equipo->errors);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /equipo/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
			$equipo = Equipo::find($id);
        
	        if (is_null ($equipo))
        	{
        	    App::abort(404);
        	}
        	$equipo->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Equipo ' . $equipo->nombre . ' eliminado',
                        'id'      => $equipo->id
            	));
        	}
        	else
       		{
	            return Redirect::route('equipos.index');
        	}
	}

}
