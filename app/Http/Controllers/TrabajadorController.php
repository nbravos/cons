<?php

use \App\Models\Trabajador;
use \App\Models\Afp;
use \App\Models\Salud;
use Carbon\Carbon;

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
		$trabajadores = Trabajador::select(['id', 'nombre', 'ap_paterno', 'fecha_termino']);
		if (request()->ajax()){
		                return Datatables::of($trabajadores)

		->addColumn('action', function ($trabajador) {
                return '<a href="/trabajador/'.$trabajador->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')

        ->editColumn('fecha_termino', function ($trabajador) {
		        return $trabajador->fecha_termino ? with(new Carbon($trabajador->fecha_termino))->format('d-m-Y') : '';
		        })
        
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
                $data['fecha_termino'] = date('Y-m-d', strtotime($data['fecha_termino']));
		
  	//	dd($data);	      	


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
        

        $input = Input::only('nombre', 'ap_paterno', 'estado_contrato','ap_materno', 'rut', 'email', 'telefono', 'direccion', 'id_afp', 'id_salud', 'fecha_nac', 'fecha', 'fecha_termino');

	
        
        if ($trabajador->isValidUpdate($input))
        {

	$input['fecha'] = date('Y-m-d', strtotime($input['fecha']));
	$input['fecha_nac'] = date('Y-m-d', strtotime($input['fecha_nac']));
	$input['fecha_termino'] = date('Y-m-d', strtotime($input['fecha_termino']));

	if (Input::hasFile('foto')){
		File::delete(public_path().'workerImage', $trabajador->foto);
		$file = Input::file('foto');
		$fileArray = array('image' => $file);

		if ($trabajador->validaFoto($fileArray)){
			$destino = public_path('workerImage');
			$extension = $file->getClientOriginalExtension();
			$imageName = $trabajador->rut.'.'.$extension;
//			Image::make(Input::file('foto')->resize(300, 200);
			$file->move($destino, $imageName);
			$trabajador->foto = $imageName;

		}
		else
        {
		//dd($data);
            return Redirect::route('trabajador.edit', $trabajador->id)->withInput()->withErrors($trabajador->errors);
        }

		

	}
	
            $trabajador->fill($input);
           
            $trabajador->save();
            return Redirect::route('trabajador.index');
        }
        else
        {
            return Redirect::route('trabajador.edit', $trabajador->id)->withInput()->withErrors($trabajador->errors);
        }
	}

	public function filtroIndex($id)
	{
		if($id == 0)
		{ /*cero es todos*/
			$trabajadores = Trabajador::select(['id', 'nombre', 'ap_paterno', 'fecha_termino']);
		if (request()->ajax()){
		                return Datatables::of($trabajadores)

		->addColumn('action', function ($trabajador) {
                return '<a href="/trabajador/'.$trabajador->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
        ->editColumn('fecha_termino', function ($trabajador) {
		        return $trabajador->fecha_termino ? with(new Carbon($trabajador->fecha_termino))->format('d-m-Y') : '';
		        })
            ->make(true);
        	}
    	}
        else {
        	if($id == 1){
        		/*1 es contrato vigente*/
        		$trabajadores = Trabajador::select(['id', 'nombre', 'ap_paterno', 'fecha_termino'])
        		->where('estado_contrato', '=', '1');
        		if (request()->ajax()){
		                return Datatables::of($trabajadores)

		->addColumn('action', function ($trabajador) {
                return '<a href="/trabajador/'.$trabajador->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
        ->editColumn('fecha_termino', function ($trabajador) {
		        return $trabajador->fecha_termino ? with(new Carbon($trabajador->fecha_termino))->format('d-m-Y') : '';
		        })
            ->make(true);

        	}

        }
        if ($id == 2) {
        	$trabajadores = Trabajador::select(['id', 'nombre', 'ap_paterno', 'fecha_termino'])
        		->where('estado_contrato', '=', '0');
        		if (request()->ajax()){
		                return Datatables::of($trabajadores)

		->addColumn('action', function ($trabajador) {
                return '<a href="/trabajador/'.$trabajador->id.'" class="btn btn-info"> Ver</a>';		                
                })
        ->editColumn('id', ' {{$id}}')
        ->editColumn('fecha_termino', function ($trabajador) {
		        return $trabajador->fecha_termino ? with(new Carbon($trabajador->fecha_termino))->format('d-m-Y') : '';
		        })
            ->make(true);

        	}
        }

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

        	File::delete(public_path().'workerImage', $trabajador->foto);
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
