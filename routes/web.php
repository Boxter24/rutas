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
Route::get('/inverso', 'InversoController@inverso')->name('inverso');

Route::get('/crear', 'UserController@crear')->name('crear');
Route::get('/editar', 'UserController@editar')->name('editar');
Route::get('/borrar', 'UserController@borrar')->name('borrar');

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::Exportar Excel:::::::::::::::::::::::::::::::::::*/
Route::get('/excel', 'ExportacionController@excel')->name('exportar.excel');