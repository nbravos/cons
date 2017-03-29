<?php

use \App\Models\Ordencompra;
use \App\Models\Documento;

class DocumentoController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /documento
	 *
	 * @return Response
	 */
	public function index()
	{
		//$documentos = Documento::paginate();  

		 $documentos = Documento::select(['id', 'tipo', 'monto', 'fecha']);
		if (request()->ajax()){
		                return Datatables::of($documentos)

		->addColumn('action', function ($documento) {
                return '<a href="/documentos/'.$documento->id.'" class="btn btn-info"> Ver</a>';		                
                })
       /* ->editColumn('id', '{{$id}}')*/
            ->make(true);
        }
	        return view('site/documentos/list')->with('documentos', $documentos);

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /documento/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$ocs = Ordencompra::pluck('numero', 'id');
		
		return View::make('site/documentos/form', ['ocs' => $ocs]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /documento
	 *
	 * @return Response
	 */
	public function store()
	{
		$documento = new Documento;
		
		$data = Input::all();		
		//dd($data);
		if($documento->isValid($data))
		{


	   		$fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha']);
			$data['fecha'] = $fecha1->format("Y-m-d h:i:s");     
	        $documento->fill($data);
		    $documento->save();
		    $id = $documento->id;
			$destino = 'documents';
		  	$extension = Input::file('rutadoc')->getClientOriginalExtension();
		  	$fileName = $id.'.'.$extension;
		  	$data['rutadoc'] = $fileName;
		    Input::file('rutadoc')->move($destino, $fileName);
		    $data['rutadoc'] = $fileName;
            $fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha']);
			$data['fecha'] = $fecha1->format("Y-m-d h:i:s");
		    $documento->fill($data);	
		    $documento->save();

		    





		    return Redirect::route('documentos.index'); 

		}
		else
		{
			//dd($documento->errors);
			return Redirect::route('documentos.create')->withInput()->withErrors($documento->errors);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /documento/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$documento = Documento::find($id);
		 if (is_null ($documento))
                {
                        App::abort(404)->with('message', 'Documento no encontrado');
                }

		
                return View::make('site/documentos/show', array('documento' => $documento));
		
	}
	
	/*public function download($id)
	{

	$file_path = "documents/'.$id.'.jpg";
	   if (file_exists($file_path))
	{

		return Response::download($file_path);
	}
	else
	{
	        exit('Documento no encontrado');

	}

	}*/

	/**
	 * Show the form for editing the specified resource.
	 * GET /documento/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$documento = Documento::find($id);
		if (is_null ($documento))
		{
			App::abort(404);
		}

		$ocs = Ordencompra::pluck('numero', 'id');

		return View::make('site/documentos/form')->with('documento', $documento)
												 ->with('ocs', $ocs);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /documento/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$documento = Documento::find($id);
        
     	if (is_null ($documento))
        {
            App::abort(404);
        }
        

        $data = Input::all();


        
        if ($documento->isValid($data))
        {

		$fecha1 = DateTime::createFromFormat('d/m/Y', $data['fecha']);
		$data['fecha'] = $fecha1->format("Y-m-d h:i:s");
		$documento->fill($data);   
        $documento->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('documentos.index');

        }
        else
        {
		//dd($data);
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('documentos.edit', $documento->id)->withInput()->withErrors($documento->errors);
        }

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /documento/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$documento = Documento::find($id);
        
	        if (is_null ($documento))
        	{
        	    App::abort(404);
        	}
        	$documento->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Documento ' . $documento->nombre . ' eliminado',
                        'id'      => $documento->id
            	));
        	}
        	else
       		{
	            return Redirect::route('documentos.index');
        	}
	
	}

}
