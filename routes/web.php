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

//si doy todo, a pesar de guardar, se hace get.

Route::get('/Actividad/all', 'ActividadController@index'); 
Route::get('/Actividad/show/{id}', 'ActividadController@show'); 
Route::post('/Actividad/destroy/{id}', 'ActividadController@destroy');
Route::post('/Actividad/store', 'ActividadController@store');
Route::put('/Actividad/{actividad}', 'ActividadController@update');

Route::get('/Aeropuerto/all', 'AeropuertoController@index'); 
Route::get('/Aeropuerto/show/{id}', 'AeropuertoController@show'); 
Route::post('/Aeropuerto/destroy/{id}', 'AeropuertoController@destroy');
Route::get('/Aeropuerto/store', 'AeropuertoController@store');

Route::get('/Alojamiento/all', 'AlojamientoController@index'); 
Route::get('/Alojamiento/show/{id}', 'AlojamtienoController@show'); 
Route::post('/Alojamiento/destroy/{id}', 'AlojamientoController@destroy');
Route::get('/Alojamiento/store', 'AlojamientoController@store');

Route::get('/Asiento/all', 'AsientoController@index'); 
Route::get('/Asiento/show/{id}', 'AsientoController@show'); 
Route::post('/Asiento/destroy/{id}', 'AsientoController@destroy');
Route::get('/Asiento/store', 'AsientoController@store');

Route::get('/Auditoria/all', 'AuditoriaController@index'); 
Route::get('/Auditoria/show/{id}', 'AuditoriaController@show'); 
Route::post('/Auditoria/destroy/{id}', 'AuditoriaController@destroy');
Route::get('/Auditoria/store', 'AuditoriaController@store');

Route::get('/Auto/all', 'AutoController@index'); 
Route::get('/Auto/show/{id}', 'AutoController@show'); 
Route::post('/Auto/destroy/{id}', 'AutoController@destroy');
Route::get('/Auto/store', 'AutoController@store');

Route::get('/Ciudad/all', 'CiudadController@index'); 
Route::get('/Ciudad/show/{id}', 'CiudadController@show'); 
Route::post('/Ciudad/destroy/{id}', 'CiudadController@destroy');
Route::get('/Ciudad/store', 'CiudadController@store');

Route::get('/Compra/all', 'CompraController@index'); 
Route::get('/Compra/show/{id}', 'CompraController@show'); 
Route::post('/Compra/destroy/{id}', 'CompraController@destroy');
Route::get('/Compra/store', 'CompraController@store');

Route::get('/CompraReservaVuelo/all', 'CompraReservaVueloController@index'); 
Route::get('/CompraReservaVuelo/show/{id}', 'CompraReservaVueloController@show'); 
Route::post('/CompraReservaVuelo/destroy/{id}', 'CompraReservaVueloController@destroy');
Route::get('/CompraReservaVuelo/store', 'CompraReservaVueloController@store');

Route::get('/CuentaBancaria/all', 'CuentaBancariaController@index'); 
Route::get('/CuentaBancaria/show/{id}', 'CuentaBancariaController@show'); 
Route::post('/CuentaBancaria/destroy/{id}', 'CuentaBancariaController@destroy');
Route::get('/CuentaBancaria/store', 'CuentaBancariaController@store');

Route::get('/Empresa/all', 'EmpresaController@index'); 
Route::get('/Empresa/show/{id}', 'EmpresaController@show'); 
Route::post('/Empresa/destroy/{id}', 'EmpresaController@destroy');
Route::get('/Empresa/store', 'EmpresaController@store');


Route::get('/Habitacion/all', 'HabitacionController@index'); 
Route::get('/Habitacion/show/{id}', 'HabitacionController@show'); 
Route::post('/Habitacion/destroy/{id}', 'HabitacionController@destroy');
Route::get('/Habitacion/store', 'HabitacionController@store'); 

Route::get('/MedioDePago/all', 'MedioDePagoController@index'); 
Route::get('/MedioDePago/show/{id}', 'MedioDePagoController@show'); 
Route::post('/MedioDePago/destroy/{id}', 'MedioDePagoController@destroy');
Route::get('/MedioDePago/store', 'MedioDePagoController@store');

Route::get('/Pais/all', 'PaisController@index'); 
Route::get('/Pais/show/{id}', 'PaisController@show'); 
Route::post('/Pais/destroy/{id}', 'PaisController@destroy');
Route::get('/Pais/store', 'PaisController@store');

Route::get('/Paquete/all', 'PaqueteController@index'); 
Route::get('/Paquete/show/{id}', 'PaqueteController@show'); 
Route::post('/Paquete/destroy/{id}', 'PaqueteController@destroy');
Route::get('/Paquete/store', 'PaqueteController@store');

Route::get('/PaqueteReservaVuelo/all', 'PaqueteReservaVueloController@index'); 
Route::get('/PaqueteReservaVuelo/show/{id}', 'PaqueteReservaVueloController@show'); 
Route::post('/PaqueteReservaVuelo/destroy/{id}', 'PaqueteReservaVueloController@destroy');
Route::get('/PaqueteReservaVuelo/store', 'PaqueteReservaVueloController@store');

Route::get('/Pasajero/all', 'PasajeroController@index'); 
Route::get('/Pasajero/show/{id}', 'PasajeroController@show'); 
Route::post('/Pasajero/destroy/{id}', 'PasajeroController@destroy');
Route::get('/Pasajero/store', 'PasajeroController@store');

Route::get('/ReservaAuto/all', 'ReservaAutoController@index'); 
Route::get('/ReservaAuto/show/{id}', 'ReservaAutoController@show'); 
Route::post('/ReservaAuto/destroy/{id}', 'ReservaAutoController@destroy');
Route::get('/ReservaAuto/store', 'ReservaAutoController@store');

Route::get('/ReservaHabitacion/all', 'ReservaHabitacionController@index'); 
Route::get('/ReservaHabitacion/show/{id}', 'ReservaHabitacionController@show'); 
Route::post('/ReservaHabitacion/destroy/{id}', 'ReservaHabitacionController@destroy');
Route::get('/ReservaHabitacion/store', 'ReservaHabitacionController@store');

Route::get('/ReservaVuelo/all', 'ReservaVueloController@index'); 
Route::get('/ReservaVuelo/show/{id}', 'ReservaVueloController@show'); 
Route::post('/ReservaVuelo/destroy/{id}', 'ReservaVueloController@destroy');
Route::get('/ReservaVuelo/store', 'ReservaVueloController@store');

Route::get('/Rol/all', 'RolController@index'); 
Route::get('/Rol/show/{id}', 'RolController@show'); 
Route::post('/Rol/destroy/{id}', 'RolController@destroy');
Route::get('/Rol/store', 'RolController@store');

Route::get('/Seguro/all', 'SeguroController@index'); 
Route::get('/Seguro/show/{id}', 'SeguroController@show'); 
Route::post('/Seguro/destroy/{id}', 'SeguroController@destroy');
Route::get('/Seguro/store', 'SeguroController@store');

Route::get('/Ubicacion/all', 'UbicacionController@index'); 
Route::get('/Ubicacion/show/{id}', 'UbicacionController@show'); 
Route::post('/Ubicacion/destroy/{id}', 'UbicacionController@destroy');
Route::get('/Ubicacion/store', 'UbicacionController@store');

Route::get('/UsuarioMedioDePago/all', 'UsuarioMedioDePagoController@index'); 
Route::get('/UsuarioMedioDePago/show/{id}', 'UsuarioMedioDePagoController@show'); 
Route::post('/UsuarioMedioDePago/destroy/{id}', 'UsuarioMedioDePagoController@destroy');
Route::get('/UsuarioMedioDePago/store', 'UsuarioMedioDePagoController@store');

Route::get('/Vuelo/all', 'VueloController@index'); 
Route::get('/Vuelo/show/{id}', 'VueloController@show'); 
Route::post('/Vuelo/destroy/{id}', 'VueloController@destroy');
Route::get('/Vuelo/store', 'VueloController@store');