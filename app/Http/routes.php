
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

Route::get('login', 'AuthController@showLogin'); // Mostrar login
Route::post('login', 'AuthController@postLogin'); // Verificar datos

Route::group(['middleware' => 'web'], function () {
    


/*Controlador de CRUD usuarios*/
Route::resource('usuarios', 'UsersController');

Route::get('cuadrillas/addtrab/{id}',['uses' =>'CuadrillaController@createfromProyecto'])->name('addTrab');
Route::resource('cuadrillas', 'CuadrillaController');

Route::get('ofertas/getEmpGan/{id}', ['uses' => 'ProyectoContratistaController@verOfertasEmpresa'])->name('getEmpGan');
Route::get('ofertas/getfilFecha/{from}/{to}/{idempresa}', ['uses' =>'ProyectoContratistaController@filtroFecha']);
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
/*Rutas resource*/
Route::get('documentos/getfilFecha/{from}/{to}', ['uses' =>'DocumentoController@filtroFecha']);
Route::resource('documentos', 'DocumentoController');

Route::get('trabajador/getfilFecha/{from}/{to}', ['uses' =>'TrabajadorController@filtroFecha'])->name('getFechaTrab');
Route::get('trabajador/getfil/{id}', ['uses' =>'TrabajadorController@filtroIndex'])->name('getfil');
Route::get('trabajador/getfilPro/{id}', ['uses' =>'TrabajadorController@filtroProyecto'])->name('getfilPro');

Route::resource('trabajador', 'TrabajadorController');

Route::get('oc/getProy/{id}', ['uses' =>'OrdenCompraController@filtroIndex']);//filtro Index
Route::resource('oc', 'OrdenCompraController');

Route::post('partidas/addtrabajador/{id}', ['uses' => 'PartidaController@storeTrabajadorObra'])->name('storeTrabajadorObra');
Route::get('partidas/addtrabajador/{id}', ['uses'=> 'PartidaController@addTrabajadorObra'])->name('agregaTrabajadorObra');
Route::get('partidas/asistenciaDiaria/{id}', ['uses' => 'PartidaController@getTablaAsistencia'])->name('asistenciaDiaria');
Route::get('partidas/graficoAsistenciaDiaria/{id_obra}/{id_trabajador}', ['uses' => 'PartidaController@graficoAsistenciaDiaria']);
Route::get('partidas/obra/{id}', ['uses' => 'PartidaController@vistaObra'])->name('getObra');
Route::get('partidas/getIndex/{id}', ['uses' => 'PartidaController@index2'])->name('getIndex');
Route::get('partidas/getIndex3/{id}', ['uses' => 'PartidaController@index3'])->name('getIndex3');
Route::get('partidas/getDrop/{id}', ['uses' => 'PartidaController@dropProyectos'])->name('getProyActivo');
Route::get('cuadrillas/create/{id}',['uses' =>'CuadrillaController@create'])->name('addCuad');
Route::get('partidas/proyecto/{id}', ['uses' =>'PartidaController@verPartProyecto'])->name('verPart');
Route::resource('partidas', 'PartidaController');

Route::get('proyectos/getfilFecha/{from}/{to}', ['uses' =>'ProyectoController@filtroFecha']);
Route::get('proyectos/getcom/{id}', ['uses' =>'ProyectoController@filtroComuna'])->name('getComuna');
Route::get('proyectos/getman/{id}', ['uses' =>'ProyectoController@filtroMandante'])->name('getMand');
Route::resource('proyectos', 'ProyectoController');
//Route::get('proyectos/getJoinProyecto', 'ProyectoController@getJoinData');

//Rutas Graficos:
Route::get('reportes/avances', ['uses' => 'ReporteController@vistaAvances']); //vista avances
Route::get('reportes/selectObraAvance/{id}', ['uses' => 'ReporteController@selectBoxAvance']); //selectbox avances
Route::get('reportes/avanceObra/{id}', ['uses' => 'ReporteController@avancesGrafico']); //grafico de avances x partida
Route::get('reportes/montoOferta', ['uses' =>'ReporteController@tablaOfertas']); //carga página montos ofertados
Route::get('reportes/montoOfertado/{id}', ['uses' =>'ReporteController@graficOfertas']); //grafico montos
Route::get('reportes/asistencia', ['uses' =>'ReporteController@vistaAsistencia']); //carga página asistencia
Route::get('reportes/graficoAsistenciaDiaria/{id_trabajador}/{desde}/{hasta}', ['uses' => 'ReporteController@asistenciaGrafico']);//grafico de asistencia
Route::get('reportes/getTrabajadores/{id}', ['uses' => 'ReporteController@getTrabDropdown'])->name('getProyAsistencia'); //carga dropdown trabajadores
Route::get('reportes/getChartTrab/{id}', ['uses' => 'ReporteController@grapAsistenciaTrabajador']); //carga gráfico trabajadores
Route::get('reportes/getTablaTrab/{id}', ['uses' => 'ReporteController@tablaAsistenciaTrabajador']);
Route::get('reportes/test', 'ReporteController@graficos');
Route::resource('reportes', 'ReporteController', ['only'=> ['index']]);

Route::resource('sueldos', 'SueldoController');

Route::get('ofertas/create/{id}',['uses' =>'ProyectoContratistaController@create'])->name('addof');
Route::get('ofertas/ver/{id}', ['uses' =>'ProyectoContratistaController@verOfertasProyecto'])->name('verof');
Route::get('ofertas/empresa/{id}', ['uses' =>'ProyectoContratistaController@verOfertasEmpresa'])->name('verofEmp');
Route::resource('ofertas', 'ProyectoContratistaController');

//Route::get('items/doc/{id}',['uses' => 'ItemController@fromdocumento'])->name('moditem');
//Route::get('items/add', ['uses' =>'ItemController@storeandcreate'])->name('additem');
//Route::post('items/mod', ['uses' => 'ItemController@storefromdoc'])->name('additemdoc');
/*Route::post('items/mod', 'ItemController@storefromdoc');*/
Route::resource('items', 'ItemController');

Route::get('mantencion/add/{id}', ['uses' => 'MantencionController@create'])->name('addMant');
Route::get('mantencion/ver/{id}', ['uses' => 'MantencionController@verMantencionEquipo'])->name('verMant');
Route::resource('mantencion', 'MantencionController');

//Route::get('login', 'AuthController@showLogin'); // Mostrar login
//Route::post('login', 'AuthController@postLogin'); // Verificar datos
/*Route::get('logout', 'AuthController@logOut'); // Finalizar sesión*/


/*Rutas para usuarios con autenticación solamente*/
Route::group(['middleware' => 'auth'], function()//
{//
	Route::get('/home', ['uses' => 'HomeController@show', 'as' => 'home']); 
	Route::get('logout', 'AuthController@logOut'); // Finalizar sesión	

}); //



Route::get('remind', ['uses' => 'RemindersController@getRemind'])->name('recuperar');
Route::post('remind', ['uses' => 'RemindersController@postRemind'])->name('password.reset');
Route::get('reset/{token}', 'RemindersController@getReset')->name('reestablecer');
Route::post('reset', 'RemindersController@postReset')->name('resetpass');





/*Controlador Index Público*/
Route::get('noticias', 'IndexController@showNews');
Route::get('post', 'IndexController@showPost');
Route::get('servicios', 'IndexController@showServices');
Route::get('about', 'IndexController@showWho');
Route::get('contacto', 'IndexController@showContact');
Route::post('contacto', 'ContactoController@email')->name('contacto');
Route::get('/', 'IndexController@showIndex');
//Route::get('construction-index', 'IndexController@showIndex');

});




