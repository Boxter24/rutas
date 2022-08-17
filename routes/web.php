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
/*::::::::::::::::::::::::::::::::::A TIEMPO:::::::::::::::::::::::::::::::::::*/
Route::get('/a-tiemmpo', 'A_TiempoController@index')->name('a_tiempo');
Route::get('/crear-a-tiemmpo', 'A_TiempoController@crear')->name('crear_a_tiempo');
Route::get('/editar-a-tiemmpo', 'A_TiempoController@editar')->name('editar_a_tiempo');
Route::get('/borrar-a-tiemmpo', 'A_TiempoController@borrar')->name('borrar_a_tiempo');
Route::get('/cambiar-estado-a-tiemmpo', 'A_TiempoController@cambiarEstado')->name('cambiar_estado_a_tiempo');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::COMPLETADAS:::::::::::::::::::::::::::::::::::*/
Route::get('/completadas', 'CompletadasController@index')->name('completadas');
Route::get('/crear-completadas', 'CompletadasController@crear')->name('crear_completadas');
Route::get('/editar-completadas', 'CompletadasController@editar')->name('editar_acompletadas');
Route::get('/borrar-completadas', 'CompletadasController@borrar')->name('borrar_completadas');
Route::get('/cambiar-estado-completadaso', 'CompletadasController@cambiarEstado')->name('cambiar_estado_completadas');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Exportar Excel:::::::::::::::::::::::::::::::::::*/
Route::get('/excel-export', 'ExportacionController@excel')->name('exportar.excel');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar Excel:::::::::::::::::::::::::::::::::::*/
Route::post('/excel-import', 'ImportacionController@excel')->name('importar.excel');


/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar PDF:::::::::::::::::::::::::::::::::::*/
Route::get('/rutas/imprimir', 'ExportacionController@pdf')->name('exportar.pdf');
