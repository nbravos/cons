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
//	dd($trabajadores["7"]);
        return View::make('site/cuadrillas/form')
        ->with('partida', $partida)
        ->with('trabajadores', $trabajadores);
	
	
    }

    public function createfromProyecto($id){
        
        $partidas = Partida::where('id_proyecto', $id)->pluck('nombre', 'id');
        $trabajadores = Trabajador::all();
        return View::make('site/cuadrillas/form_proy')
         ->with('partidas', $partidas)
         ->with('trabajadores', $trabajadores);

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
        $cuad->nombre = $data['nombre'];
        $cuad->id_partida = $data['id_partida'];
        $cuad->descripcion = $data['descripcion'];
        $cuad->fill($data);
        $cuad->save();    

            $trabajadores =  $data['trabajadores'];
            foreach ($trabajadores as $trabajador) {
                $id_trabajador = $trabajador;
                $id_cuadrilla = $cuad->id;
                $cuad->trabajadores()->attach($id_trabajador);
            }

           
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
        $cuadrilla = Cuadrilla::find($id);
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
        $cuadrilla = Cuadrilla::find($id);
        
            if (is_null ($cuadrilla))
            {
                App::abort(404);
            }
            $cuadrilla->delete();

            if (Request::ajax())
            {
                    return Response::json(array (
            'success' => true,
            'msg'     => 'Equipo ' . $cuadrilla->nombre . ' eliminada',
                        'id'      => $cuadrilla->id
                ));
            }
            else
            {
                return Redirect::route('cuadrillas.index');
            }
    }
}
