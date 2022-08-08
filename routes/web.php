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

Route::get('/crear', 'RutasController@crear')->name('crear');
Route::get('/editar', 'RutasController@editar')->name('editar');
Route::get('/borrar', 'RutasController@borrar')->name('borrar');
Route::get('/cambiar-estado', 'RutasController@cambiarEstado')->name('cambiar.estado');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Exportar Excel:::::::::::::::::::::::::::::::::::*/
Route::get('/excel-export', 'ExportacionController@excel')->name('exportar.excel');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar Excel:::::::::::::::::::::::::::::::::::*/
Route::post('/excel-import', 'ImportacionController@excel')->name('importar.excel');


/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Importar PDF:::::::::::::::::::::::::::::::::::*/
Route::get('/rutas/imprimir', 'ExportacionController@pdf')->name('exportar.pdf');
