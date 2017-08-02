<?php

use \App\Models\User;


use Yajra\Datatables\Datatables;

use Illuminate\Notifications\Notifiable;
class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	//protected $perPage = 2;

	public function index()
	{
	      
	   //  $users = User::paginate();  //Users::all() trae todos los usuarios, paginate() crea páginas con 15 registros cada una

               $users = User::select(['name', 'email']);
		if (request()->ajax()){
		                return Datatables::of($users)

             ->addColumn('action', function ($user) {
               return '<a href="/usuarios/'.$user->id.'" class="btn btn-info"> Ver</a>';
               return '<a href="/usuarios/'.$user->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
            })
            //->editColumn('id', ' {{$id}}')
            ->removeColumn('password')
            ->make(true);
		}
	      return View::make('site/usuarios/list')->with('users', $users);
		//return $datatable->render('site/usuarios/list');

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	      return View::make('site/usuarios/form');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;

		//Se obtiene la data del usuario
		$data = Input::all();
		

		//Comprueba que sea válido
		if($user->validAndSafe($data))
		{
	            
		    return Redirect::route('usuarios.index')->with('message', 'Usuario Guardado'); 

		}
		else
		{
			//Si no se valida redirige a create con los errores qeu se encontraron
			return Redirect::route('usuarios.create')->withInput()->withErrors($user->errors);
		}		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		 if (is_null ($user))
                {
                        App::abort(404)->with('message', 'Usuario no encontrado');
                }
                return View::make('site/usuarios/show', array('user' => $user));
		

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		/*if (is_null ($user))
		{
			App::abort(404);
		}*/

		return View::make('site/usuarios/form')->with('user', $user);

	
	}


		public function update($id, Illuminate\Http\Request $request)
		{
		    $user = User::find($id);
		    $newPassword = $request->get('password');

		    if(empty($newPassword)){
		        $user->update($request->except('password'));
		    }else{
		        $user->update($request->all());
		    }
		    return Redirect::route('usuarios.index');
		}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 
	public function update($id)
	{
	// Creamos un nuevo objeto para nuestro nuevo usuario
        $user = User::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
       if (is_null ($user))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
//	Log::info('email - '.Input::get('email'));
//      Log::info('name - '.Input::get('name'));

        
        // Revisamos si la data es válido
        if ($user->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $user->fill($data);
            // Guardamos el usuario
            $user->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('usuarios.index');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('usuarios.form')->withUser($user->$id)->withErrors($user->errors);
        }
}*/
                




	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
       		$user = User::find($id);
        
	        if (is_null ($user))
        	{
        	    App::abort(404);
        	}
        	$user->delete();

	        if (Request::ajax())
        	{
	                return Response::json(array (
			'success' => true,
			'msg'     => 'Usuario ' . $user->name . ' eliminado',
                        'id'      => $user->id
            	));
        	}
        	else
       		{
	            return Redirect::route('usuarios.index');
        	}
	}
	




}
