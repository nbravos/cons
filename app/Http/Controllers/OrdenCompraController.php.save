<?php

use \App\Models\Empresa;
use \App\Models\Partida;
use \App\Models\Ordencompra;
use \App\Models\Item;
//use Session;

class OrdenCompraController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /ordencompra
	 *
	 * @return Response
	 */
	public function index()
	{
	   
  
        $ocs = DB::table('orden_compra')->join('partida', 'partida.id', '=' ,'orden_compra.id_partida')->select(['orden_compra.id', 'partida.item', 'orden_compra.numero', 'orden_compra.fecha_emision']);
       if (request()->ajax()){
		                return Datatables::of($ocs)
       
             ->addColumn('action', function ($oc) {
                return '<a href="/oc/'.$oc->id.'" class="btn btn-info"> Ver</a>';		                
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
		}
            return View::make('site/oc/list');


 


    }

	/**
	 * Show the form for creating a new resource.
	 * GET /ordencompra/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$empresa = Empresa::pluck('nombre', 'id');
                $partida = Partida::pluck('nombre', 'id');
		return View::make('site/oc/form')
					->with('empresa', $empresa)
                                        ->with('partida', $partida);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ordencompra
	 *
	 * @return Response
	 */
	public function store()
	{
		$oc = new Ordencompra;

		//Se obtiene la data del usuario
		$data = Input::all();
		

		//Comprueba que sea válido
		if($oc->isValid($data))
		{

		$fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha_emision']);
		$data['fecha_emision'] = $fecha1->format("Y-m-d h:i:s");
		$fecha2 = DateTime::createFromFormat('d/m/Y', $data['fecha_entrega']);
		$data['fecha_entrega'] = $fecha1->format("Y-m-d h:i:s"); 
		    $oc->fill($data);
		    $oc->save();	  
		$id = $oc->id;
		          
		   // return Redirect::route('oc.index'); 
		Session::put('idorden', $id);
		
			return View::make('site/item/form');

		}
		else
		{
			//Si no se valida redirige a create con los errores qeu se encontraron
			return Redirect::route('oc.create')->withInput()->withErrors($oc->errors);
 
		}		
	}

	/**
	 * Display the specified resource.
	 * GET /ordencompra/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		 $oc = Ordencompra::find($id);
		 if (is_null ($oc))
          {
            App::abort(404)->with('message', 'Orden de Compra no encontrada');
          }
	     $empresa = Empresa::pluck('nombre', 'id');
             $partida = Partida::pluck('nombre', 'id');

            return View::make('site/oc/show', array('oc' => $oc))->with('empresa', $empresa)->with('partida', $partida);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /ordencompra/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	 $empresa = Empresa::pluck('nombre', 'id');
         $partida = Partida::pluck('nombre', 'id');

	$oc= Ordencompra::find($id);
        return View::make('site/oc/form')->with('empresa', $empresa)
                                         ->with('partida', $partida)
					 ->with('oc', $oc);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /ordencompra/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$oc = Ordencompra::find($id);
        
     	if (is_null ($oc))
        {
            App::abort(404);
        }
        
        $data = Input::all();


        if ($oc->isValid($data))
        {
	
		$fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha_emision']);
		$data['fecha_emision'] = $fecha1->format("Y-m-d h:i:s");
		$fecha2 = DateTime::createFromFormat('d/m/Y', $data['fecha_entrega']);
		$data['fecha_entrega'] = $fecha1->format("Y-m-d h:i:s"); 
            $oc->fill($data);
           
            $oc->save();
            return Redirect::route('oc.index');
        }
        else
        {
            return Redirect::route('oc.edit', $oc->id)->withInput()->withErrors($oc->errors);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /ordencompra/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$oc = Ordencompra::find($id);
        
	        if (is_null ($oc))
        	{
        	    App::abort(404);
        	}
        	$oc->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Orden de Compra de' . $oc->partida . ' eliminado',
                        'id'      => $oc->id
            	));
        	}
        	else
       		{
	            return Redirect::route('oc.index');
        	}
	}

}
