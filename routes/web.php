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
    return view('contenido/contenido');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Rutas de las especialidades
Route::get('/especialidad', 'EspecialidadController@index');
Route::post('/especialidad/registrar', 'EspecialidadController@store');
Route::put('/especialidad/actualizar', 'EspecialidadController@update');

//Rutas de los signos vitales
Route::get('/signosvitales', 'SignoVitalController@index');
Route::post('/signosvitales/registrar', 'SignoVitalController@store');
Route::put('/signosvitales/actualizar', 'SignoVitalController@update');

//Rutas de Medicamentos
Route::get('/medicamento', 'MedicamentoController@index');
Route::post('/medicamento/registrar', 'MedicamentoController@store');
Route::put('/medicamento/actualizar', 'MedicamentoController@update');
