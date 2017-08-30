<?php



use Illuminate\Http\Request;

use \App\Models\Cuadrilla;
use \App\Models\Partida;
use \App\Models\Proyecto;
use \App\Models\Trabajador;
use \App\Models\Equipo;

class CuadrillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $cuadrillas = Cuadrilla::select(['id', 'id_partida', 'nombre', 'descripcion']);
        if (request()->ajax()){
                        return Datatables::of($cuadrillas)

        ->addColumn('action', function ($cuadrilla) {
                return '<a href="/cuadrillas/'.$cuadrilla->id.'" class="btn btn-info"> Ver</a>';                      
    })
        ->editColumn('id', ' {{$id}}')
            ->make(true);
        }
    return View::make('site/cuadrillas/list')->with('cuadrillas', $cuadrillas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $partida = DB::select(DB::raw("SELECT * FROM partida WHERE id = '$id'"));
        $trabajadores = Trabajador::all();
        $equipos = Equipo::pluck('nombre', 'id');
//	dd($trabajadores["7"]);
        return View::make('site/cuadrillas/form')
        ->with('partida', $partida)
        ->with('trabajadores', $trabajadores)
        ->with('equipos', $equipos);
	
	
    }

    public function createfromProyecto($id){
        
        $partidas = Partida::where('id_proyecto', $id)->pluck('nombre', 'id');
        $trabajadores = Trabajador::all();
        $equipos = Equipo::pluck('nombre', 'id');
        return View::make('site/cuadrillas/form_proy')
         ->with('partidas', $partidas)
         ->with('trabajadores', $trabajadores)
         ->with('equipos', $equipos);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuad = new Cuadrilla;

        //Se obtiene la data del usuario
        $data = Input::all();
        //	dd($data);

        $fecha = DateTime::createFromFormat('d/m/Y', $data['fecha']);
        $data['fecha'] = $fecha->format("Y-m-d h:i:s");
        $cuad->fill($data);
        $cuad->save();    
        /*if (! $cart->items->contains($newItem->id)) {
    $cart->items()->save($newItem);
}*/

          /*  $trabajadores =  $data['trabajadores'];
            foreach ($trabajadores as $trabajador) {
                $id_trabajador = $trabajador;
                $id_cuadrilla = $cuad->id;
                $cuad->trabajadores()->attach($id_trabajador);
                
            }

	        $equipo = $data['equipo'];
            $id_equipo = $equipo;
            $id_cuadrilla = $cuad->id;
            

            date_default_timezone_set("Chile/Continental");
            $fecha = date("Y-m-d H:i:s"); 
            $estado = 1;
	        $cuad->equipos()->attach($id_equipo, ['fecha' => $fecha, 'estado' => $estado]);*/
           
            return Redirect::route('cuadrillas.index'); 
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuadrilla = Cuadrilla::with('trabajadores')->find($id);
	//dd($cuadrilla);
      
         /* $cuadrillas = DB::table('cuadrilla')
          ->join('cuadrilla_trabajador',function($join) use ($id) {
            $join->on('cuadrilla_trabajador.id_cuadrilla' '=', 'cuadrilla.id')
            ->where('cuadrilla.id', '=', $id)
          })
          ->select(['cuadrilla.id', 'cuadrilla.id_partida', 'cuadrilla.nombre', 'cuadrilla.descripcion', 'cuadrilla.']);*/
	
         if (is_null ($cuadrilla))
          {
            App::abort(404)->with('message', 'Cuadrilla no  encontrado');
          }
            return View::make('site/cuadrillas/show', array('cuadrilla' => $cuadrilla));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuadrilla =  Cuadrilla::find($id);
        $partidas = Partida::pluck('nombre', 'id');
        $trabajadores =  Trabajador::all();
         $equipos = Equipo::pluck('nombre', 'id');
        //$trabajadores = DB::select(DB::raw("SELECT * FROM trabajador WHERE id NOT IN (SELECT id_trabajador FROM cuadrilla_trabajador WHERE id_cuadrilla = '$id')");
        return View::make('site/cuadrillas/edit')->with('cuadrilla', $cuadrilla)->with('partidas', $partidas)->with('trabajadores', $trabajadores)->with('equipos', $equipos);

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
	$data =  Input::all();

        $cuad = Cuadrilla::find($id);

        if(!empty($data['fecha'])){

            $fecha = DateTime::createFromFormat('d/m/Y', $data['fecha']);
            $data['fecha'] = $fecha->format("Y-m-d H:i:s");


        }
        $cuad->fill($data);
        $cuad->save();  
            return Redirect::route('cuadrillas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuadrilla = Cuadrilla::find($id);
        
            if (is_null ($cuadrilla))
            {
                App::abort(404);
            }
            $cuadrilla->delete();

            if (request()->ajax())
            {
                    return Response::json(array (
            'success' => true,
            'msg'     => 'Cuadrilla ' . $cuadrilla->nombre . ' eliminada',
                        'id'      => $cuadrilla->id
                ));
            }
            else
            {
                return Redirect::route('cuadrillas.index');
            }
    }
}
