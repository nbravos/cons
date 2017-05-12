<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'IndexController@showIndex');


Route::group(['middlewareGroups' => ['web']], function () {
    


/*Controlador de CRUD usuarios*/
Route::resource('usuarios', 'UsersController');
Route::resource('empresas', 'EmpresaController');
Route::resource('equipos', 'EquipoController');
Route::get('descargardoc/{filename}', ['as' => 'descargardoc',  function($filename)
{

	$filepath = 'documents/'.$filename;
	
           if (file_exists($filepath))
        {

                return Response::download($filepath);
        }
        else
        {
                exit('Documento no encontrado');

        }


}]);

Route::resource('documentos', 'DocumentoController');
Route::resource('trabajador', 'TrabajadorController');
Route::resource('oc', 'OrdenCompraController');
Route::resource('partidas', 'PartidaController');
Route::resource('proyectos', 'ProyectoController');
//Route::get('proyectos/getJoinProyecto', 'ProyectoController@getJoinData');
Route::get('reportes/test', 'ReporteController@graficos');
Route::resource('reportes', 'ReporteController');
Route::resource('sueldos', 'SueldoController');
Route::get('ofertas/create/{id}',['uses' =>'ProyectoContratistaController@create'])->name('addof');
Route::resource('ofertas', 'ProyectoContratistaController');
Route::get('items/doc/{id}',['uses' => 'ItemController@fromdocumento'])->name('moditem');
Route::get('items/add', ['uses' =>'ItemController@storeandcreate'])->name('additem');
Route::post('items/mod', ['uses' => 'ItemController@storefromdoc'])->name('additemdoc');
/*Route::post('items/mod', 'ItemController@storefromdoc');*/
Route::resource('items', 'ItemController');

Route::get('login', 'AuthController@showLogin'); // Mostrar login
Route::post('login', 'AuthController@postLogin'); // Verificar datos
/*Route::get('logout', 'AuthController@logOut'); // Finalizar sesión*/


/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);
*/

/*Rutas para usuarios con autenticación solamente*/
Route::group(['middleware' => 'auth'], function()
{
	Route::get('/home', ['uses' => 'HomeController@show', 'as' => 'home']); 
	Route::get('logout', 'AuthController@logOut'); // Finalizar sesión	

}); 


Route::get('remind', 'RemindersController@getRemind');
Route::post('remind', 'RemindersController@postRemind');

Route::get('password/reset/{token}', 'RemindersController@getReset');
Route::post('password/reset/{token}', 'RemindersController@postReset');



/*Route::get('password/reset', array( 
	'uses' => 'RemindersController@getRemind',
	'as' => 'password.remind'
));

Route::post('password/reset', array(
        'uses' => 'RemindersController@postRemind',
        'as' => 'password.remind'
));*/




/*Controlador Index Público*/
Route::get('noticias', 'IndexController@showNews');
Route::get('post', 'IndexController@showPost');
Route::get('servicios', 'IndexController@showServices');
Route::get('about', 'IndexController@showWho');
Route::get('contacto', 'IndexController@showContact');
Route::get('/', 'IndexController@showIndex');
//Route::get('construction-index', 'IndexController@showIndex');

});




