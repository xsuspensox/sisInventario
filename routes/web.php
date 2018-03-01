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
    return view('/auth/login');
});


Route::resource('/almacen/categoria','CategoriaController');
Route::resource('/almacen/producto','ProductoController');
Route::resource('/salidas/personal','PersonalController');
Route::resource('/compras/proveedor','ProveedorController');
Route::resource('/compras/ingreso','IngresoController');
Route::resource('/salidas/salida','SalidaController');
Route::resource('/seguridad/usuario','UsuarioController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
