<?php



use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$items = DB::table('item')
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('site/item/form');
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
	
	if($item->isValid($data))
        {

            $item->fill($data);
            $item->save();
     
		 $idoc = Session::get('idorden');
	    
		$item->ordencompra()->attach($idoc);	
             return Redirect::route('items.index'); 

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

	public function fromdocumento()
    {

	$idoc_orden = Session::get('idocumento');

    $itemorden =DB::select(DB::raw("SELECT id_item FROM orden_item WHERE id_orden = '$idoc_orden'"));
   

    foreach ($itemorden as $value) {
            $it = $value->id_item;
    }

    $items = DB::select(DB::raw("SELECT * FROM item WHERE id = '$it'"));
    

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
                return View::make('site/item/act')->with('items', $items);
        
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
        //
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
