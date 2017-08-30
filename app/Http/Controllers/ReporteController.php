<?php


use App\Models\Reporte;
use Khill\Lavacharts\Lavacharts;
use App\Models\Proyecto;
use App\Models\Proyectocontratista;
use App\Models\Empresa;
use Carbon\Carbon; 

class ReporteController extends Controller
{

public function index()
    {
                return view('site/reportes/list');
    }


public function asistencia() //carga vista
{
    $proyectos = Proyecto::pluck('nombre', 'id');
    return View::make('site/reportes/asistencia')->with('proyectos', $proyectos);

}

public function getTrabDropdown($id){ //carga el dropdown de trabajadores


    $trabajadores = DB::table('trabajador')
        ->join('proyecto_trabajador', function($join) use ($id) {
                        $join->on('proyecto_trabajador.id_trabajador', '=', 'trabajador.id')
                        ->where('proyecto_trabajador.id_proyecto', '=', $id);
                    })->select('trabajador.id', 'trabajador.nombre', 'trabajador.ap_paterno')->get();
    
 
return response()->json($trabajadores);


}

public function grapAsistenciaTrabajador($id) //grafico de la asistencia x trabajador x proyecto
{

   

//    $asist = \Lava::DataTable();
    $data = DB::table('asistencia')
        ->join('trabajador', function($join) use ($id) {
                        $join->on('trabajador.id', '=', 'asistencia.id_trabajador')
                        ->where('asistencia.id_trabajador', '=', $id);
                    }) 
        ->select(['trabajador.nombre', 'trabajador.ap_paterno', 'asistencia.presente', 'asistencia.atraso', 'asistencia.fecha'])->get();

/*        $asist->addDateColumn('Fecha')
                ->addNumberColumn('Presente')
                ->addNumberColumn('Atraso')
                ->setDateTimeFormat('d-m-Y');
                for($i=0; $i < count($data); $i++){

                    $data[$i]->fecha = Carbon::createFromFormat('Y-m-d H:i:s', $data[$i]->fecha)->format('d-m-Y');
                    $asist->addRow([$data[$i]->fecha, $data[$i]->atraso, $data[$i]->presente]);
                }*/
                
     /*  \Lava::ColumnChart('Asistencia', $asist, [
            'title' => 'Asistencia de: ' .$data[0]->nombre.$data[0]->ap_paterno ,
            'titleTextStyle' =>[
                'color' => '#eb6b2c',
                'fontSize' => 14,
                ]
            ]); */
	

//	return 'asiste' => $asist->toJson()];
	 //$jsonData['graph'] = $asist->toJson();
	 //return $jsonData;
  	   return response()->json($data);
//        return $asist->toJson();
//        return View::make('site/reportes/asistencia', compact('lava'));
        //return View::make('site/reportes/asistencia');

}
    public function tablaAsistenciaTrabajador($id){
        $data = DB::table('asistencia')
        ->join('trabajador', function($join) use ($id) {
                        $join->on('trabajador.id', '=', 'asistencia.id_trabajador')
                        ->where('asistencia.id_trabajador', '=', $id);
                    }) 
    ->select(['trabajador.id', 'trabajador.nombre', 'trabajador.ap_paterno as apellido', 'asistencia.presente', 'asistencia.atraso as ausente', 'asistencia.fecha']);
	   
    if (request()->ajax()){
                        return Datatables::of($data)
	 ->editColumn('fecha', function ($data) {
		        return $data->fecha ? with(new Carbon($data->fecha))->format('d-m-Y H:i:s') : '';
			
            })
                         ->make(true);

    }
   

}

    public function graficos(/*$value*/)
    {
    	$lava = new Lavacharts;
    	
    	$contratistas = $lava->DataTable();

    	$data = DB::table('proyecto_contratista')
    		->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
    		->join('empresa', 'empresa.id', '=', 'proyecto_contratista.id_empresa')
    		->select(['empresa.nombre', 'proyecto_contratista.monto_ofertado'])->get()->toArray();
            //dd($data[0]->nombre);

    	$contratistas
    		->addStringColumn('Contratistas')
    		->addNumberColumn('Montos Ofertados');
            
            for ($i=0; $i < count($data); $i++) { 
               $contratistas->addRow([$data[$i]->nombre, $data[$i]->monto_ofertado]);
            }
            
    	$lava->ColumnChart('Contratistas', $contratistas, [
    		'title' => 'Monto por Contratista en Proyectos', 
    		'titleTextStyle' =>[
    			'color' => '#eb6b2c',
    			'fontSize' => 14,
    		]
    	]);	

            return view('site/reportes/test', compact('lava'));
    }
}
