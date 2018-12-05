<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de las especialidades

Route::get('/especialidad', 'EspecialidadController@index');
Route::post('/especialidad', 'EspecialidadController@store');
Route::put('/especialidad', 'EspecialidadController@update');
Route::delete('/especialidad', 'EspecialidadController@destroy');

//rutas de los horarios
Route::get('/horario', 'HorarioController@index');
Route::post('/horario', 'HorarioController@store');
Route::put('/horario', 'HorarioController@update');
Route::delete('/horario', 'HorarioController@destroy');

// Rutas de los departamentos
Route::get('/departamento', 'DepartamentoController@index');
Route::post('/departamento', 'DepartamentoController@store');
Route::put('/departamento', 'DepartamentoController@update');
Route::delete('/departamento', 'DepartamentoController@destroy');

// Ruta de los municipios
Route::get('/municipio', 'MunicipioController@index');
Route::post('/municipio', 'MunicipioController@store');
Route::put('/municipio', 'MunicipioController@update');
Route::delete('/municipio', 'MunicipioController@destroy');

//Rutas de los signos vitales
/*Route::get('/signosvitales', 'SignoVitalController@index');
Route::post('/signosvitales', 'SignoVitalController@store');
Route::put('/signosvitales', 'SignoVitalController@update');
Route::delete('/signosvitales', 'SignoVitalController@destroy');*/
// Ruta de las direcciones
Route::get('/direccion', 'DireccionController@index');
Route::post('/direccion', 'DireccionController@store');
Route::put('/direccion', 'DireccionController@update');
Route::delete('/direccion', 'DireccionController@destroy');

// Ruta de las personas
Route::get('/persona', 'PersonaController@index');
Route::post('/persona', 'PersonaController@store');
Route::put('/persona', 'PersonaController@update');
Route::delete('/persona', 'PersonaController@destroy');

// Ruta de las direcciones de clinica

Route::get('/clinica', 'ClinicaController@index');
Route::post('/clinica','ClinicaController@store');
Route::put('/clinica', 'ClinicaController@update');
Route::delete('/clinica', 'ClinicaController@destroy');

// Rutas de los pacientes
Route::get('/paciente', 'PacienteController@index');
Route::post('/paciente','PacienteController@store');
Route::put('/paciente', 'PacienteController@update');
Route::delete('/paciente', 'PacienteController@destroy');

// Rutas de los profesionales en medicina
Route::get('/pem', 'ProfesionalEnMedicinaController@index');
Route::post('/pem','ProfesionalEnMedicinaController@store');
Route::put('/pem', 'ProfesionalEnMedicinaController@update');
Route::delete('/pem', 'ProfesionalEnMedicinaController@destroy');
// Rutas de los  toma de signos vitales
Route::get('/tdsv', 'TomaDeSignoVitalController@index');
Route::post('/tdsv','TomaDesignoVitalController@store');
Route::put('/tdsv', 'TomaDeSignoVitalController@update');
Route::delete('/tdsv', 'TomaDeSignoVitalController@destroy');

// Rutas de  consulta
Route::get('/consulta', 'ConsultaController@index');
Route::post('/consulta','ConsultaController@store');
Route::put('/consulta', 'ConsultaController@update');
Route::delete('/consulta', 'ConsultaController@destroy');

// Rutas de trabajadores
Route::get('/trabajador', 'TrabajadorController@index');
Route::post('/trabajador','TrabajadorController@store');
Route::put('/trabajador', 'TrabajadoresController@update');
Route::delete('/trabajador', 'TrabajadoresController@destroy');

// Rutas de los roles
Route::get('/rol', 'RolController@index');
Route::post('/rol','RolController@store');
Route::put('/rol', 'RolController@update');
Route::delete('/rol', 'RolController@destroy');

Route::get('/user', 'UserController@index');
Route::post('/user','UserController@store');
Route::put('/user', 'UserController@update');
Route::delete('/user', 'UserController@destroy');

// Rutas de horario de clinica
Route::get('/horarioclinica', 'HorarioDeClinicaController@index');
Route::post('/horarioclinica','HorarioDeClinicaController@store');
Route::put('/horarioclinica', 'HorarioDeClinicaController@update');

// Rutas de servicios
Route::get('/servicios', 'ServicioController@index');
Route::post('/servicios','ServicioController@store');
Route::put('/servicios', 'ServicioController@update');
Route::delete('/servicios', 'servicioController@destroy');

//rutas de Orden de Tratamiento Medico
Route::get('/rdtm', 'OrdenDeTratamientoMedicoController@index');
Route::post('/odtm','OrdenDeTratamientoMedicoController@store');
Route::put('/odtm', 'OrdenDeTratamientoMedicoController@update');
Route::delete('/odtm', 'OrdenDeTratamientoMedicoController@destroy');
