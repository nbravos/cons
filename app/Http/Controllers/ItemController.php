<?php



use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Documento;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*$itemorden = DB::table('orden_item')->where(function ($query) use ($idoc_orden) {
    $query->where('orden_item.id_orden', '=', $idoc_orden);
    })->get();
    ->join('orden_item', 'orden_item.id_item', '=', 'item.id')
                    ->join('orden_compra', 'orden_compra.id', '=', 'orden_item.id_orden')
                    ->select(['item.id', 'item.detalle', 'item.unitario',  'orden_compra.numero']);
       if (request()->ajax()){
                        return Datatables::of($items)
       
             ->addColumn('action', function ($item) {
                return '<a href="/item/'.$item->id.'" class="btn btn-info"> Ver</a>';                       
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
        }
            return View::make('site/item/list');       
*/
    public function index()
    {
            $idoc_orden = Session::get('idindex');
            $items = DB::table('item')
            ->join('orden_item', 'orden_item.id_item', '=', 'item.id')
                    ->join('orden_compra', 'orden_compra.id', '=', 'orden_item.id_orden')
                    ->select(['item.id', 'item.detalle', 'item.unitario',  'orden_compra.numero']);
		
               /* $items = DB::table('item')
                ->join('orden_item', 'orden_item.id_item', '=', 'item.id')
                ->join('orden_compra', function($join) use($idoc_orden){
                    $join->on( 'orden_item.id_orden', '=', $idoc_orden);
                }) 7 abril -  malo */
    
       if (request()->ajax()){
                        return Datatables::of($items)
       
             ->addColumn('action', function ($item) {
                return '<a href="/item/'.$item->id.'" class="btn btn-info"> Ver</a>';                       
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
        }
            return View::make('site/item/list');    
        }    

/*$items = DB::table('item')
		    ->join('orden_item', 'orden_item.id_item', '=', 'item.id')
                    ->join('orden_compra', 'orden_compra.id', '=', 'orden_item.id_orden')
                    ->select(['item.id', 'item.detalle', 'item.unitario',  'orden_compra.numero']);
       if (request()->ajax()){
                        return Datatables::of($items)
       
             ->addColumn('action', function ($item) {
                return '<a href="/item/'.$item->id.'" class="btn btn-info"> Ver</a>';                       
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
        }
            return View::make('site/item/list');        
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	
        return View::make('site/item/form');
    }

    public function createfromdoc()
    {
    
        return View::make('site/item/new');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $item = new Item;
	$data = Input::all();
    	$boton = $data['button1'];
	//dd($data);
	if($item->isValid($data))
        {

            $item->cantidad = $data['cantidad'];
            $item->detalle = $data['detalle'];
            $item->unidad = $data['unidad'];
            $item->unitario = $data['unitario'];
            $item->save();
         
		 $idoc = Session::get('idorden');
	     
		$item->ordencompra()->attach($idoc);
          
         $id_index = $item->ordencompra();
	     $id_index = $item->ordencompra['0']->id;
        Session::put('idindex', $id_index);
        if($boton == '2'){

            return Redirect::route('items.create');
        }else { if($boton == '1'){
             return Redirect::route('items.index'); 
         }
        }

        }
        else
        {
            //Si no se valida redirige a create con los errores qeu se encontraron
            return Redirect::route('items.create')->withInput()->withErrors($item->errors);
 
        }       
    }

    public function storeandcreate(Request $request)
    {
    
    $item = new Item;
    $data = Input::all();
    dd($data);
    if($item->isValid($data))
        {

            $item->fill($data);
            $item->save();
         
         $idoc = Session::get('idorden');
         
        $item->ordencompra()->attach($idoc);
          
        $item->ordencompra->id_orden;
        Session::put('idindex', $id_index);
            
             return Redirect::route('items.create'); 

        }
        else
        {
            //Si no se valida redirige a create con los errores qeu se encontraron
            return Redirect::route('items.create')->withInput()->withErrors($item->errors);
 
        }       
    }

    /*$week = DB::select('SELECT week FROM calendar WHERE year = 2015 and month = 01 and day = 30');
     foreach ($week as $weekvalue)
{
   echo  $weekname=$weekvalue->week;
}

$secondResult = DB::select("SELECT * FROM calendar WHERE year = 2015 and week = $weekname");
return View::make('calendar')->with('weekdays',$secondResult);
*/

     public function newfromdoc(Request $request)
    {
    $item = new Item;
    $data = Input::all();
//  dd($data);
    if($item->isValid($data))
        {

            $item->fill($data);
            $item->save();
         
         $idoc = Session::get('idorden');
         
        $item->ordencompra()->attach($idoc);
          
         $id_index = $item->ordencompra();
         $id_index = $item->ordencompra['0']->id;
        Session::put('idindex', $id_index);
            
             return Redirect::route('items.index'); 

        }
        else
        {
            //Si no se valida redirige a create con los errores qeu se encontraron
            return Redirect::route('items.create')->withInput()->withErrors($item->errors);
 
        }       
    }

	public function fromdocumento($id)//vista para modificar items desde vista de documento 
    {

	$idoc_orden = Session::get('idocumento');

    $itemorden =DB::select(DB::raw("SELECT id_item FROM orden_item WHERE id_orden = '$idoc_orden'"));
    //dd($itemorden);
    //dd(count($itemorden));
	Session::put('id_doc_final', $id);
	
    foreach ($itemorden as $value) {
        echo  $it[] = $value->id_item;
    }
	
    
    $items = DB::table('item')->select('*')->whereIn('id', $it)->get();

    //$items = DB::select(DB::raw("SELECT * FROM item WHERE id IN (".implode(',',$arrayName).")"));
    //dd($items);
    //$items = DB::table('item')->select('*')->whereIn('id', $it)->get();

    /*$items = DB::select(DB::raw("SELECT * FROM item WHERE id = '$it'"));*/
    
/*  $sql = 'SELECT * 
          FROM `table` 
         WHERE `id` IN (' . implode(',', array_map('intval', $array)) . ')'; */
    /*$itemorden = DB::table('orden_item')->where(function ($query) use ($idoc_orden) {
    $query->where('orden_item.id_orden', '=', $idoc_orden);
    })->get();
    foreach ($itemorden as $value) {
        echo $queryid=$value->id_item;
    }
    //dd($itemorden);
    dd($itemorden['id_item']);
    

    $items = DB::table('item')->where(function ($query2) use ($queryid){
        $query2->where('item.id', '=', $queryid);
    })->get(); */
       /* $items =  DB::table('item')
                    ->join('orden_item', function($join) use ($idoc_orden)
			{

				$join->on('orden_item.id_orden', '=', DB::raw('"'.$idoc_orden.'"'));

			})
                    ->get();*/
	//dd($itemorden = $itemorden->keyBy('id_item'));
                return View::make('site/item/act')->with('items', $items)->with('id', $id);
        
    }

	  

	  public function storefromdoc()//guarda desde documento
    {
        $data = Input::all();
        //dd($data['cantidad'][0]);
	//(count($data['cantidad']));
	/*       for ($i=0; $i < count($data['cantidad']); $i++){
             DB::table('item')->insert(array('cantidad' => '$data[$i]->cantidad', 
							   'unidad' => '$data[$i]->unidad',
						            'id_item_dos' => '$data[$i]->$id')
            							);*/
	$idoc_orden = Session::get('id_doc_final');
	//dd($idoc_orden);
	for ($i=0; $i < count($data['cantidad']); $i++){

	$item = new Item;
	$item->cantidad = $data['cantidad'][$i];
	$item->detalle = $data['detalle'][$i];
	$item->unidad = $data['unidad'][$i];
	$item->unitario = $data['unitario'][$i];
	$item->id_item_dos = $data['id_item_dos'][$i];
	$item->save();

	
	 $item->documento()->attach($idoc_orden);

    
	}
        return redirect('home');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $items = Item::find($id);
        if (is_null ($documento))
        {
            App::abort(404);
        }

        $ocs = Ordencompra::pluck('numero', 'id');

        return View::make('site/documentos/edit')->with('documento', $documento)
                                                 ->with('ocs', $ocs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
