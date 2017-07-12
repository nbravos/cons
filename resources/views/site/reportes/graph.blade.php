<?php

//Gráficos:


public function graficos(/*$value*/)
    {
    	//Contratista v/s Proyectos 
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

    	//Monto ofertado v/s Monto Disponible 
    	$lava = new Lavacharts;
    	$monto = $lava->DataTable();

    	$data = DB::table('proyecto')
    		->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
    		->join('proyecto_contratista', 'empresa.id', '=', 'proyecto_contratista.id_empresa')
    		->select(['proyecto.monto_disponible','proyecto_contratista.monto_ofertado'])->get()->toArray();

    	//Trabajadores	vs Asistencia
    		$data = DB::table('trabajador')
    		->join('proyecto', 'proyecto.id', '=', 'proyecto_contratista.id_proyecto')
    		->join('proyecto_contratista', 'empresa.id', '=', 'proyecto_contratista.id_empresa')
    		->select(['proyecto.monto_disponible','proyecto_contratista.monto_ofertado'])->get()->toArray();

}

/*SELECT Asistencia.Trabajador_id, Asistencia.presente, Asistencia.atraso, Asistencia.fecha FROM Asistencia INNER JOIN Trabajador ON Asistencia.Trabajad
or_id=Trabajador.id*/