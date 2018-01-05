<?php


use App\Models\Reporte;
use Khill\Lavacharts\Lavacharts;
use App\Models\Proyecto;
use App\Models\Proyectocontratista;
use App\Models\Empresa;
use Carbon\Carbon; 
use App\Models\Partida; 
use App\Models\Trabajador;

class ReporteController extends Controller
{

public function index()
    {
                return view('site/reportes/list');
    }

public function tablaOfertas(){ //tabla y vista de ofertas
    $ofertas = DB::table('proyecto')
                ->join('proyecto_contratista', 'proyecto_contratista.id_proyecto', '=', 'proyecto.id')
                ->join('empresa as contratista', 'contratista.id', '=' ,'proyecto_contratista.id_empresa')
                ->join('empresa as mandante', 'mandante.id', '=' ,'proyecto.id_empresa')
                ->select('proyecto.nombre as obra', 'proyecto_contratista.monto_ofertado as monto', 'proyecto_contratista.fecha_oferta as fecha', 'proyecto_contratista.estado_oferta as estado', 'contratista.nombre as contratista', 'mandante.nombre as mandante');
		//dd($ofertas);
                if(request()->ajax()){
			
                    return Datatables::of($ofertas)

                    ->make(true);
                }
                $proyectos = Proyecto::pluck('nombre', 'id');
                return View::make('site/reportes/ofertas')->with('ofertas', $ofertas)->with('proyectos', $proyectos);

}


public function graficOfertas($id) //grafico de las ofertas
{
    $ofertas = DB::table('proyecto')
                ->join('proyecto_contratista', function($join) use ($id){
                    $join->on('proyecto_contratista.id_proyecto', '=', 'proyecto.id')
                        ->where('proyecto.id', '=', $id);
                })                
                ->join('empresa as contratista', 'contratista.id', '=' ,'proyecto_contratista.id_empresa')
                ->join('empresa as mandante', 'mandante.id', '=' ,'proyecto.id_empresa')
                ->select('proyecto.nombre as obra', 'proyecto_contratista.monto_ofertado as monto', 'proyecto_contratista.fecha_oferta as fecha', 'proyecto_contratista.estado_oferta as estado', 'contratista.nombre as contratista', 'mandante.nombre as mandante')->get();
                return $ofertas;


}


public function getTrabDropdown($id){ //carga el dropdown de trabajadores de la asistencia


    $trabajadores = DB::table('trabajador')
        ->join('proyecto_trabajador', function($join) use ($id) {
                        $join->on('proyecto_trabajador.id_trabajador', '=', 'trabajador.id')
                        ->where('proyecto_trabajador.id_proyecto', '=', $id);
                    })->select('trabajador.id', 'trabajador.nombre', 'trabajador.ap_paterno')->get();
    
 
return response()->json($trabajadores);


}

public function vistaAsistencia() { //carga página de las asistencias
    $trabajadores = DB::table('trabajador')
                        ->select('nombre', 'ap_paterno', 'id')->get();
    return View::make('site/reportes/asistencia_reporte')->with('trabajadores', $trabajadores);

}

public function asistenciaGrafico($id_trabajador, $desde, $hasta){ //grafico asistencia por trabajador
        
        $partidas = Partida::pluck('id');        
        

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

public function vistaAvances(){

    return View::make('site/reportes/avances');

}

public function selectBoxAvance($id){
    $partidas = DB::table('partida')
                ->select('partida.nombre', 'partida.id')
                ->where('partida.id_proyecto', '=', $id)
                ->get();
                return response()->json($partidas);


}

public function avancesGrafico($id){
    $avances = DB::table('avance')
                ->select('cantidad', 'porcentaje', 'fecha_inicio as inicio', 'fecha_termino as termino');
    return(json_encode($avances));

}


public function grapAsistenciaTrabajador($id) //grafico de la asistencia x trabajador x proyecto
{

   


	
  	   return $result;

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
