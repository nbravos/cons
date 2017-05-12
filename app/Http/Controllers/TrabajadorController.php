<?php

use \App\Models\Trabajador;
use \App\Models\Afp;
use \App\Models\Salud;
class TrabajadorController extends Controller {


	/**
	 * Display a listing of the resource.
	 * GET /trabajador
	 *
	 * @return Response
	 */
	public function index()
	{
		//$trabajadores = Trabajador::paginate();  
		$trabajadores = Trabajador::select(['id', 'nombre', 'telefono']);
		if (request()->ajax()){
		                return Datatables::of($trabajadores)

		->addColumn('action', function ($trabajador) {
                return '<a href="/trabajador/'.$trabajador->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        }

        return View::make('site/trabajador/list')->with('trabajadores', $trabajadores);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /trabajador/create
	 *
	 * @return Response
	 */
	public function create()
	{
			$afp = Afp::pluck('nombre', 'id');
			$salud = Salud::pluck('nombre', 'id');

			return View::make('site/trabajador/form')
					->with('afp', $afp)
					->with('salud', $salud);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /trabajador
	 *
	 * @return Response
	 */
	public function store()
	{
		$trabajador = new Trabajador;
		$data = Input::all();
                $data['fecha'] = date('Y-m-d', strtotime($data['fecha']));
                $data['fecha_nac'] = date('Y-m-d', strtotime($data['fecha_nac']));
		
  		//dd($data);	      	


		if($trabajador->isValid($data))
		{
		   

		  	$destino = public_path('workerImage');
		  	$extension = Input::file('foto')->getClientOriginalExtension();
		  	$imageName = Input::get('rut').'.'.$extension;
//			Image::make(Input::file('foto')->resize(300, 200);
		  	Input::file('foto')->move($destino, $imageName);
		  	$data['foto'] = $imageName;
 		    $trabajador->fill($data);
		    $trabajador->save();	         
		    return Redirect::route('trabajador.index'); 

		}
		else
		{
			return Redirect::route('trabajador.create')->withInput()->withErrors($trabajador->errors);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /trabajador/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$trabajador = Trabajador::find($id);
		 if (is_null ($trabajador))
                {
                        App::abort(404)->with('message', 'Trabajador no encontrado');
                }
                return View::make('site/trabajador/show', array('trabajador' => $trabajador));
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
		$trabajador = Trabajador::find($id);
		if (is_null ($trabajador))
		{
			App::abort(404);
		}
	$afp = Afp::pluck('nombre', 'id');
        $salud = Salud::pluck('nombre', 'id');

        return View::make('site/trabajador/edit')
					->with('salud', $salud)
					->with('afp', $afp)
					->with('trabajador', $trabajador);
	
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
		$trabajador = Trabajador::find($id);
        
     	if (is_null ($trabajador))
        {
            App::abort(404);
        }
        

        $data = Input::all();


        
        if ($trabajador->isValidUpdate($data))
        {

	$data['fecha'] = date('Y-m-d', strtotime($data['fecha']));
	$data['fecha_nac'] = date('Y-m-d', strtotime($data['fecha_nac']));

	

            // Si la data es valida se la asignamos al usuario
            $trabajador->fill($data);
           
            $trabajador->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('trabajador.index');
        }
        else
        {
		//dd($data);
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('trabajador.edit', $trabajador->id)->withInput()->withErrors($trabajador->errors);
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
		$trabajador = Trabajador::find($id);
        
	        if (is_null ($trabajador))
        	{
        	    App::abort(404);
        	}
        	$trabajador->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Trabajador ' . $trabajador->nombre . ' eliminado',
                        'id'      => $trabajador->id
            	));
        	}
        	else
       		{
	            return Redirect::route('trabajador.index');
        	}
	}

}
