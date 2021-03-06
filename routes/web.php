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
Route::get('/especialidad/selectEspecialidad', 'EspecialidadController@selectEspecialidad');

//Rutas de los signos vitales
Route::get('/signosvitales', 'SignoVitalController@index');
Route::post('/signosvitales/registrar', 'SignoVitalController@store');
Route::put('/signosvitales/actualizar', 'SignoVitalController@update');

//Rutas de Medicamentos
Route::get('/medicamento', 'MedicamentoController@index');
Route::post('/medicamento/registrar', 'MedicamentoController@store');
Route::put('/medicamento/actualizar', 'MedicamentoController@update');

//Rutas para Servicio
Route::get('/servicio', 'ServicioController@index');
Route::post('/servicio/registrar', 'ServicioController@store');
Route::put('/servicio/actualizar', 'ServicioController@update');

//Rutas para Profesionales en Medicina
Route::get('/pem', 'ProfesionalEnMedicinaController@index');
Route::post('/pem/registrar','ProfesionalEnMedicinaController@store');
Route::put('/pem/actualizar', 'ProfesionalEnMedicinaController@update');

//Rutas de trabajador
Route::get('/trabajador/selectTrabajador','TrabajadorController@selectTrabajador');

Route::get('/clinica', function () {
    return view('clinica/clinica');
});

Route::get('/consulta', function () {
    return view('consulta/consulta');
});

Route::get('/especialidades', function () {
    return view('especialidad/especialidad');
});

Route::get('/signovital', function () {
    return view('signosvitales/signosvitales');
});