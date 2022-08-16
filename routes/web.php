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
/*::::::::::::::::::::::::::::::::::Exportar Excel:::::::::::::::::::::::::::::::::::*/
Route::get('/excel-export', 'ExportacionController@excel')->name('exportar.excel');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar Excel:::::::::::::::::::::::::::::::::::*/
Route::post('/excel-import', 'ImportacionController@excel')->name('importar.excel');


/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar PDF:::::::::::::::::::::::::::::::::::*/
Route::get('/rutas/imprimir', 'ExportacionController@pdf')->name('exportar.pdf');
