<?php

use \App\Models\Empresa;

use Yajra\Datatables\Datatables;
use \App\Helpers;

class EmpresaController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /empresa
	 *
	 * @return Response
	 */
	public function index()
	{
		/* $empresas = Empresa::paginate();  */
//	      return View::make('site/empresas/list')->with('empresas', $empresas);
	               $empresas = Empresa::select(['id', 'nombre', 'nombre_contacto', 'telefono']);
		if (request()->ajax()){
		                return Datatables::of($empresas)

		->addColumn('action', function ($empresa) {
                return '<a href="/empresas/'.$empresa->id.'" class="btn btn-info"> Ver</a>';		                
		})
	    ->editColumn('id', '{{$id}}')
            ->make(true);
        }
	              return View::make('site/empresas/list')->with('empresas', $empresas);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /empresa/create
	 *
	 * @return Response
	 */
	public function create()
	{
		/*$options = [
	        'Mandante' => 'Mandante',
        	'Proveedor' => 'Proveedor',
	        'Contratista' => 'Contratista',
   		 ];*/
		return View::make('site/empresas/form');/*, array('options' => $options));*/
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /empresa
	 *
	 * @return Response
	 */
	public function store()
	{
		$empresa = new Empresa;

		//Se obtiene la data del usuario
		$data = Input::all();
		//dd($data);	
		
		//Comprueba que sea válido
		if(($empresa->isValid($data)) && (Custom::validaRut($data['rut'])))
		{
		    $empresa->tipo_proovedor = null;
		    $empresa->fill($data);
		
		    if(! $data['tipo_provedor']) {
                        $empresa->tipo_proveedor = null;
	                }

		    $empresa->save();	            
		    return Redirect::route('empresas.index'); 

		}
		else
		{
			//Si no se valida redirige a create con los errores qeu se encontraron
			return Redirect::route('empresas.create')->withInput()->withErrors($empresa->errors)->with('errorMessageDuration', 'Error en el Rut');; //- Errores tienen que ser con ajax
		}		
	}

	/**
	 * Display the specified resource.
	 * GET /empresa/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$empresa = Empresa::find($id);
		 if (is_null ($empresa))
                {
                        App::abort(404)->with('message', 'Empresa no encontrada');
                }
                return View::make('site/empresas/show', array('empresa' => $empresa));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /empresa/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$empresa = Empresa::find($id);
		/* $options = [
                'Mandante' => 'Mandante',
                'Proveedor' => 'Proveedor',
                'Contratista' => 'Contratista',
                 ];*/

		/*if (is_null ($user))
		{
			App::abort(404);
		}*/

		/*return View::make('site/empresas/form', array('options' => $options))->with('empresa', $empresa);*/
                return View::make('site/empresas/form')->with('empresa', $empresa);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /empresa/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		 $empresa = Empresa::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
     /*  if (is_null ($empresa))
        {
            App::abort(404);
        }*/
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();


        
        // Revisamos si la data es válido
        if ($empresa->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $empresa->fill($data);
           
            $empresa->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('empresas.index');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('empresas.edit')->withUser($empresa->$id)->withErrors($empresa->errors);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /empresa/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$empresa = Empresa::find($id);
        
	        if (is_null ($empresa))
        	{
        	    App::abort(404);
        	}
        	$empresa->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Empresa ' . $empresa->nombre . ' eliminado',
                        'id'      => $empresa->id
            	));
        	}
        	else
       		{
	            return Redirect::route('empresas.index');
        	}
	}

}
