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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::RUTAS:::::::::::::::::::::::::::::::::::*/
Route::get('/crear', 'RutasController@crear')->name('crear');
Route::get('/editar', 'RutasController@editar')->name('editar');
Route::get('/borrar', 'RutasController@borrar')->name('borrar');
Route::get('/cambiar-estado', 'RutasController@cambiarEstado')->name('cambiar.estado');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::UNIDADES DE NEGOCIOS:::::::::::::::::::::::::::::::::::*/
Route::get('/unidades-de-negocios', 'UnidadesDeNegociosController@index')->name('unidades_de_negocios');
Route::get('/crear-unidad-de-negocios', 'UnidadesDeNegociosController@crear')->name('crear_unidad_de_negocios');
Route::get('/editar-unidad-de-negocios', 'UnidadesDeNegociosController@editar')->name('editar_unidad_de_negocios');
Route::get('/borrar-unidad-de-negocios', 'UnidadesDeNegociosController@borrar')->name('borrar_unidad_de_negocios');
Route::get('/cambiar-estado-unidad-de-negocios', 'UnidadesDeNegociosController@cambiarEstado')->name('cambiar_estado_unidad_de_negocios');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::PAISES:::::::::::::::::::::::::::::::::::*/
Route::get('/paises', 'PaisesController@index')->name('paises');
Route::get('/crear-pais', 'PaisesController@crear')->name('crear_pais');
Route::get('/editar-pais', 'PaisesController@editar')->name('editar_pais');
Route::get('/borrar-pais', 'PaisesController@borrar')->name('borrar_pais');
Route::get('/cambiar-estado-pais', 'PaisesController@cambiarEstado')->name('cambiar_estado_pais');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::VEHÍCULOS:::::::::::::::::::::::::::::::::::*/
Route::get('/vehiculos', 'VehiculosController@index')->name('vehiculos');
Route::get('/crear-vehiculo', 'VehiculosController@crear')->name('crear_vehiculo');
Route::get('/editar-vehiculo', 'VehiculosController@editar')->name('editar_vehiculo');
Route::get('/borrar-vehiculo', 'VehiculosController@borrar')->name('borrar_vehiculo');
Route::get('/cambiar-estado-vehiculo', 'VehiculosController@cambiarEstado')->name('cambiar_estado_vehiculo');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::CARGA:::::::::::::::::::::::::::::::::::*/
Route::get('/carga', 'CargasController@index')->name('cargas');
Route::get('/crear-carga', 'CargasController@crear')->name('crear_carga');
Route::get('/editar-carga', 'CargasController@editar')->name('editar_carga');
Route::get('/borrar-carga', 'CargasController@borrar')->name('borrar_carga');
Route::get('/cambiar-estado-carga', 'CargasController@cambiarEstado')->name('cambiar_estado_carga');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::TIPO ACCESORIO:::::::::::::::::::::::::::::::::::*/
Route::get('/tipo-accesorio', 'TipoAccesorioController@index')->name('tipo_accesorio');
Route::get('/crear-tipo-accesorio', 'TipoAccesorioController@crear')->name('crear_tipo_accesorio');
Route::get('/editar-tipo-accesorio', 'TipoAccesorioController@editar')->name('editar_tipo_accesorio');
Route::get('/borrar-tipo-accesorio', 'TipoAccesorioController@borrar')->name('borrar_tipo_accesorio');
Route::get('/cambiar-estado-tipo-accesorio', 'TipoAccesorioController@cambiarEstado')->name('cambiar_estado_tipo_accesorio');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Exportar Excel:::::::::::::::::::::::::::::::::::*/
Route::get('/excel-export', 'ExportacionController@excel')->name('exportar.excel');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar Excel:::::::::::::::::::::::::::::::::::*/
Route::post('/excel-import', 'ImportacionController@excel')->name('importar.excel');


/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar PDF:::::::::::::::::::::::::::::::::::*/
Route::get('/rutas/imprimir', 'ExportacionController@pdf')->name('exportar.pdf');
