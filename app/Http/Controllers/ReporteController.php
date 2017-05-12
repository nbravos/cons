<?php


use App\Models\Reporte;
use Khill\Lavacharts\Lavacharts;
use App\Models\Proyecto;
use App\Models\Proyectocontratista;
use App\Models\Empresa;


class ReporteController extends Controller
{

public function index()
    {
                return view('site/reportes/list');
    }


    public function graficos(/*$value*/)
    {
    	//if ($value == '1')
    		//grafico: todos contratistas por proyecto (y = proyecto, x = contratista + monto ofertado)
/*$items = DB::table('item')
                ->join('orden_item', 'orden_item.id_item', '=', 'item.id')
                ->join('orden_compra', function($join) use($idoc_orden){
                    $join->on( $idoc_orden, '=', 'orden_item.id_orden');
                })*/
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


		/*$lava= new Lavacharts; // 

		$finances = $lava->DataTable();

		$finances->addDateColumn('Year')
 		        ->addNumberColumn('Sales')
        		 ->addNumberColumn('Expenses')
         		->setDateTimeFormat('Y')
         		->addRow(['2004', 1000, 400])
         		->addRow(['2005', 1170, 460])
         		->addRow(['2006', 660, 1120])
         		->addRow(['2007', 1030, 54]);

		$lava->ColumnChart('Finances', $finances, [
    		'title' => 'Company Performance',
    		'titleTextStyle' => [
        	'color'    => '#eb6b2c',
        	'fontSize' => 14
   		 ]
	]);*/
            return view('site/reportes/test', compact('lava'));
    }
}
