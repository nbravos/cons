<?php

use \App\Models\Mantencion;
use \App\Models\Fotosmantencion;
use Carbon\Carbon;

class MantencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $equipo = DB::select(DB::raw("SELECT * FROM equipo WHERE id = '$id'"));
//          dd($proyecto["0"]->nombre);
                        return View::make('site/mantencion/form')
                    ->with('equipo', $equipo);
                    
   
                    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   

      $mt = new Mantencion;
        $data =  Input::all(); 
	
        $data['fecha_inicio'] = date('Y-m-d', strtotime($data['fecha_inicio']));
        $data['fecha_termino'] = date('Y-m-d', strtotime($data['fecha_termino']));
	$mt->id_equipo = $data['id_equipo'];	
        $mt->tipo = $data['tipo'];
        $mt->fecha_inicio = $data['fecha_inicio'];
        $mt->fecha_termino = $data['fecha_termino'];
        $mt->repuesto = $data['repuesto'];
        $mt->valor_repuesto = $data['valor_repuesto'];
        $mt->lugar_repuesto = $data['lugar_repuesto'];
        $mt->nombre_taller = $data['nombre_taller'];
        $mt->valor_taller = $data['valor_taller'];
        $mt->descripcion = $data['descripcion'];
	$mt->total = $data['valor_repuesto'] + $data['valor_taller'];
        $mt->save();
//	dd($mt);
        $files = Input::file('images');
        foreach ($files as $file) {
            $picture = new Fotosmantencion;
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $destino = public_path('mantencion_equipos/'.$filename);
            $picture->foto='img/products/' . $filename;
	    $picture->id_mantencion = $mt->id;		
            $picture->save();
            //$picture->mantencion()->attach($mt->id);
        }
     return Redirect::route('equipos.index');

    }

public function verMantencionEquipo($id){

              $eqId = $id;
        $mantenciones = DB::table('mantencion')
                    ->join('equipo', function($join) use ($id) {
                        $join->on('equipo.id', '=', 'mantencion.id_equipo')
                        ->where('mantencion.id_equipo', '=', $id);
                    })
->select(['mantencion.id', 'equipo.nombre as nombre', 'repuesto', 'mantencion.valor_repuesto as valorRep',  'fecha_inicio', 'total']);
                    if(request()->ajax()){
                        return Datatables::of($mantenciones)
			 ->editColumn('fecha_inicio', function ($mantencion) {
                        return $mantencion->fecha_inicio ? with(new Carbon($mantencion->fecha_inicio))->format('d-m-Y') : '';
			 })
                        ->make(true);

                        };
                 return View::make('site/mantencion/listado')->with('eqId', $eqId);;

                    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
