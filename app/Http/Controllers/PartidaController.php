<?php

use App\Models\Proyecto; 
use App\Models\Partida;


class PartidaController extends \Controller {

	/**
	 * Display a listing of the resource.
	 * GET /partida
	 *
	 * @return Response
	 */
	public function index()
	{

	    //$partidas = Partida::paginate();  
		 $partidas = Partida::select(['id', 'nombre', 'detalle', 'total', 'inicio_real']);
		if (request()->ajax()){
		                return Datatables::of($partidas)

		->addColumn('action', function ($partida) {
                return '<a href="/partidas/'.$partida->id.'" class="btn btn-info">Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        }

	    return View::make('site/partidas/list')->with('partidas', $partidas);
	    								
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
        	//dd($data);

		if($partida->isValid($data))
		{

		    $fecha1 = DateTime::createFromFormat('d/m/Y', $data['inicio_teorico']);
            $fecha2 = DateTime::createFromFormat('d/m/Y', $data['fin_teorico']);
            $fecha3 = DateTime::createFromFormat('d/m/Y', $data['inicio_real']);
            $fecha4 = DateTime::createFromFormat('d/m/Y', $data['fin_real']);
		    $data['inicio_teorico'] = $fecha1->format("Y-m-d h:i:s");
		    $data['fin_teorico'] = $fecha2->format("Y-m-d h:i:s");
		    $data['inicio_real'] = $fecha3->format("Y-m-d h:i:s");
		    $data['fin_real'] = $fecha4->format("Y-m-d h:i:s");
		    

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
        return View::make('site/partidas/form')->with('partida', $partida)
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
	
        if ($partida->isValid($data))
        {
		
			$fecha1 = DateTime::createFromFormat('d/m/Y', $data['inicio_teorico']);
            $fecha2 = DateTime::createFromFormat('d/m/Y', $data['fin_teorico']);
            $fecha3 = DateTime::createFromFormat('d/m/Y', $data['inicio_real']);
            $fecha4 = DateTime::createFromFormat('d/m/Y', $data['fin_real']);
		    $data['inicio_teorico'] = $fecha1->format("Y-m-d h:i:s");
		    $data['fin_teorico'] = $fecha2->format("Y-m-d h:i:s");
		    $data['inicio_real'] = $fecha3->format("Y-m-d h:i:s");
		    $data['fin_real'] = $fecha4->format("Y-m-d h:i:s");
		
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
