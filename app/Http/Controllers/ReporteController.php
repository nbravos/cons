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

public function tablaOfertas(){
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
               // $proyectos = Proyecto::all();
                return View::make('site/reportes/ofertas')->with('ofertas', $ofertas)->with('proyectos', $proyectos);

}


public function graficOfertas($id) //carga vista
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


public function getTrabDropdown($id){ //carga el dropdown de trabajadores


    $trabajadores = DB::table('trabajador')
        ->join('proyecto_trabajador', function($join) use ($id) {
                        $join->on('proyecto_trabajador.id_trabajador', '=', 'trabajador.id')
                        ->where('proyecto_trabajador.id_proyecto', '=', $id);
                    })->select('trabajador.id', 'trabajador.nombre', 'trabajador.ap_paterno')->get();
    
 
return response()->json($trabajadores);


}

public function vistaAsistencia() { //carga página de las asistencias
    $trabajadores = Trabajador::all();

    return View::make('site/reportes/asistencia_reporte')->with('trabajador', $trabajador);

}

public function asistenciaGrafico($id_trabajador, $desde, $hasta){ //grafico asistencia por trabajador


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
