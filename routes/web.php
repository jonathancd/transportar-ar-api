<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/cirujano/todos', 'ReservacionController@index');
// Route::get('/cirujano/{id}/show', 'CirujanoController@show');



Route::get('/', ['middleware' => 'auth', 'uses' => function () {
    return redirect('admin');
}]);

Route::get('/login',['as' => 'login', 'uses' => 'LoginController@login']);
Route::post('/login',['as' => 'login', 'uses' => 'LoginController@auth']);


Route::group(['middleware' => 'auth'], function() {
	Route::get('/logout',['as' => 'logout', 'uses' => 'LoginController@logout']);
	Route::get('/admin', 'HomeController@index');




	Route::get('/admin/horarios', 'HorarioController@index');
	Route::get('/admin/horarios/crear', 'HorarioController@create');
	Route::post('/admin/horarios', 'HorarioController@store');
	Route::get('/admin/horarios/{id}/editar', 'HorarioController@edit');
	Route::post('/admin/horarios/activar', 'HorarioController@activar');
	Route::post('/admin/horarios/borrar', 'HorarioController@destroy');
	Route::post('/admin/horarios/{id}', 'HorarioController@update');


	Route::get('/admin/sectores', 'SectorController@index');
	Route::get('/admin/sectores/crear', 'SectorController@create');
	Route::post('/admin/sectores', 'SectorController@store');
	Route::get('/admin/sectores/{id}/editar', 'SectorController@edit');
	Route::post('/admin/sectores/activar', 'SectorController@activar');
	Route::post('/admin/sectores/borrar', 'SectorController@destroy');
	Route::post('/admin/sectores/{id}', 'SectorController@update');//AQUI HAY ERROR CUANDO REDIRECCION DESPUES DE ACTIVAR RUTA [SOLVED]
	Route::get('/admin/sectores/{id}', 'SectorController@show'); //AQUI HAY ERROR CUANDO REDIRECCION DESPUES DE ACTIVAR RUTA [SOLVED]
	

	// Route::get('/admin/rutas', 'RutaController@index');
	Route::get('/admin/sectores/{id}/rutas/crear', 'RutaController@create');
	Route::post('/admin/sectores/{id_sector}/rutas', 'RutaController@store');
	Route::get('/admin/sectores/{id_sector}/rutas/{id_ruta}/editar', 'RutaController@edit');


	Route::post('/admin/sectores/{id_sector}/rutas/{id_ruta}/activar', 'RutaController@activar'); //REVISAR QUE DA ERROR [SOLVED]
	Route::post('/admin/sectores/{id_sector}/rutas/borrar', 'RutaController@destroy');
	Route::post('/admin/sectores/{id_sector}/rutas/{id_ruta}', 'RutaController@update'); 
	Route::get('/admin/sectores/{id_sector}/rutas/{id_ruta}', 'RutaController@show');



	Route::get('/admin/rutas/{id_ruta}/paradas/crear', 'ParadaController@create');
	Route::post('/admin/rutas/{id_ruta}/paradas', 'ParadaController@store');
	Route::get('/admin/rutas/{id_ruta}/paradas/{id_parada}/editar', 'ParadaController@edit');
	Route::post('/admin/rutas/{id_ruta}/paradas/borrar', 'ParadaController@destroy');
	Route::post('/admin/rutas/{id_ruta}/paradas/{id_parada}', 'ParadaController@update');
	Route::get('/admin/rutas/{id_ruta}/paradas/{id_parada}', 'ParadaController@show');


	Route::get('/admin/paradas/{id_parada}/horario/{id_horario}/crear', 						'ParadaHorarioController@create');
	Route::post('/admin/paradas/{id_parada}/horario/{id_horario}', 							'ParadaHorarioController@store');
	Route::get('/admin/paradas/{id_parada}/horario/{id_horario}/info/{id_parada_horario}/editar', 	'ParadaHorarioController@edit');
	Route::post('/admin/paradas/{id_parada}/horario/{id_horario}/info/borrar', 'ParadaHorarioController@destroy');
	Route::post('/admin/paradas/{id_parada}/horario/{id_horario}/info/{id_parada_horario}', 		'ParadaHorarioController@update');
	Route::get('/admin/paradas/{id_parada}/horario/{id_horario}/info/{id_parada_horario}', 		'ParadaHorarioController@show');


});


Route::get('/admin/paradas/{id_parada}/horario/{id_horario}/crear', 					'ParadaHorarioController@create');


Route::post('/test', 'ParadaHorarioController@test');


// API
Route::get('/rutas/horarios', 'ApiController@inicio');

Route::get('/ruta/{id_ruta}/horario/{id_horario}', 'ApiController@ruta');

Route::get('/sector/{id}/horario/{id_horario}', 'ApiController@sector');

