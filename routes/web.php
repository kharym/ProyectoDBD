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
    return view('index');
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
Route::post('/Aeropuerto/store', 'AeropuertoController@store');
Route::put('/Aeropuerto/{aeropuerto}', 'AeropuertoController@update');


Route::get('/Alojamiento/all', 'AlojamientoController@index'); 
Route::get('/Alojamiento/show/{id}', 'AlojamtienoController@show'); 
Route::post('/Alojamiento/destroy/{id}', 'AlojamientoController@destroy');
Route::post('/Alojamiento/store', 'AlojamientoController@store');
Route::put('/Alojamiento/{alojamiento}', 'AlojamientoController@update');
//Anidados de alojamiento
Route::get('/Alojamiento/{id}/all/Habitacion', 'AlojamientoController@habitaciones'); 
Route::get('Alojamiento', 'AlojamientoController@alojamientoPais');

Route::get('/Asiento/all', 'AsientoController@index'); 
Route::get('/Asiento/show/{id}', 'AsientoController@show'); 
Route::post('/Asiento/destroy/{id}', 'AsientoController@destroy');
Route::post('/Asiento/store', 'AsientoController@store');
Route::put('/Asiento/{asiento}', 'AsientoController@update');

Route::get('/Auditoria/all', 'AuditoriaController@index'); 
Route::get('/Auditoria/show/{id}', 'AuditoriaController@show'); 
Route::post('/Auditoria/destroy/{id}', 'AuditoriaController@destroy');
Route::post('/Auditoria/store', 'AuditoriaController@store');
Route::put('/Auditoria/{auditoria}', 'auditoriaController@update');

Route::get('/Auto/all', 'AutoController@index'); 
Route::get('/Auto/show/{id}', 'AutoController@show'); 
Route::post('/Auto/destroy/{id}', 'AutoController@destroy');
Route::post('/Auto/store', 'AutoController@store');
Route::put('/Auto/{auto}', 'AutoController@update');
//Anidado
Route::get('Auto','AutoController@autosPais');


Route::get('/Ciudad/all', 'CiudadController@index'); 
Route::get('/Ciudad/show/{id}', 'CiudadController@show'); 
Route::post('/Ciudad/destroy/{id}', 'CiudadController@destroy');
Route::post('/Ciudad/store', 'CiudadController@store');
Route::put('/Ciudad/{ciudad}', 'CiudadController@update');
//Anidados de Ciudad
Route::get('/Ciudad/{id}/all/Aeropuerto', 'CiudadController@aeropuertos'); 

Route::get('/Compra/all', 'CompraController@index'); 
Route::get('/Compra/show/{id}', 'CompraController@show'); 
Route::post('/Compra/destroy/{id}', 'CompraController@destroy');
Route::post('/Compra/store', 'CompraController@store');
Route::put('/Compra/{compra}', 'CompraController@update');

Route::get('/CompraReservaVuelo/all', 'CompraReservaVueloController@index'); 
Route::get('/CompraReservaVuelo/show/{id}', 'CompraReservaVueloController@show'); 
Route::post('/CompraReservaVuelo/destroy/{id}', 'CompraReservaVueloController@destroy');
Route::post('/CompraReservaVuelo/store', 'CompraReservaVueloController@store');
Route::put('/CompraReservaVuelo/{compraReservaVuelo}', 'CompraReservaVueloController@update');

Route::get('/CuentaBancaria/all', 'CuentaBancariaController@index'); 
Route::get('/CuentaBancaria/show/{id}', 'CuentaBancariaController@show'); 
Route::post('/CuentaBancaria/destroy/{id}', 'CuentaBancariaController@destroy');
Route::post('/CuentaBancaria/store', 'CuentaBancariaController@store');
Route::put('/CuentaBancaria/{cuentaBancaria}', 'CuentaBancariaController@update');

Route::get('/Empresa/all', 'EmpresaController@index'); 
Route::get('/Empresa/show/{id}', 'EmpresaController@show'); 
Route::post('/Empresa/destroy/{id}', 'EmpresaController@destroy');
Route::post('/Empresa/store', 'EmpresaController@store');
Route::put('/Empresa/{empresa}', 'EmpresaController@update');

Route::get('/Habitacion/all', 'HabitacionController@index'); 
Route::get('/Habitacion/show/{id}', 'HabitacionController@show'); 
Route::post('/Habitacion/destroy/{id}', 'HabitacionController@destroy');
Route::post('/Habitacion/store', 'HabitacionController@store'); 
Route::put('/Habitacion/{habitacion}', 'HabitacionController@update');

Route::get('/MedioDePago/all', 'MedioDePagoController@index'); 
Route::get('/MedioDePago/show/{id}', 'MedioDePagoController@show'); 
Route::post('/MedioDePago/destroy/{id}', 'MedioDePagoController@destroy');
Route::post('/MedioDePago/store', 'MedioDePagoController@store');
Route::put('/MedioDePago/{medioDePago}', 'MedioDePagoController@update');

Route::get('/Pais/all', 'PaisController@index'); 
Route::get('/Pais/show/{id}', 'PaisController@show'); 
Route::post('/Pais/destroy/{id}', 'PaisController@destroy');
Route::post('/Pais/store', 'PaisController@store');
Route::put('/Pais/{pais}', 'PaisController@update');

Route::get('/Paquete/all', 'PaqueteController@index'); 
Route::get('/Paquete/show/{id}', 'PaqueteController@show'); 
Route::post('/Paquete/destroy/{id}', 'PaqueteController@destroy');
Route::post('/Paquete/store', 'PaqueteController@store');
Route::put('/Paquete/{paquete}', 'PaqueteController@update');

Route::get('/PaqueteReservaVuelo/all', 'PaqueteReservaVueloController@index'); 
Route::get('/PaqueteReservaVuelo/show/{id}', 'PaqueteReservaVueloController@show'); 
Route::post('/PaqueteReservaVuelo/destroy/{id}', 'PaqueteReservaVueloController@destroy');
Route::post('/PaqueteReservaVuelo/store', 'PaqueteReservaVueloController@store');
Route::put('/PaqueteReservaVuelo/{paqueteReservaVuelo}', 'PaqueteReservaVueloController@update');

Route::get('/Pasajero/all', 'PasajeroController@index'); 
Route::get('/Pasajero/show/{id}', 'PasajeroController@show'); 
Route::post('/Pasajero/destroy/{id}', 'PasajeroController@destroy');
Route::post('/Pasajero/store', 'PasajeroController@store');
Route::put('/Pasajero/{pasajero}', 'PasajeroController@update');

Route::get('/ReservaAuto/all', 'ReservaAutoController@index'); 
Route::get('/ReservaAuto/show/{id}', 'ReservaAutoController@show'); 
Route::post('/ReservaAuto/destroy/{id}', 'ReservaAutoController@destroy');
Route::post('/ReservaAuto/store', 'ReservaAutoController@store');
Route::put('/ReservaAuto/{reservaAuto}', 'ReservaAutoController@update');

Route::get('/ReservaHabitacion/all', 'ReservaHabitacionController@index'); 
Route::get('/ReservaHabitacion/show/{id}', 'ReservaHabitacionController@show'); 
Route::post('/ReservaHabitacion/destroy/{id}', 'ReservaHabitacionController@destroy');
Route::post('/ReservaHabitacion/store', 'ReservaHabitacionController@store');
Route::put('/ReservaHabitacion/{reservaHabitacion}', 'ReservaHabitacionController@update');

Route::get('/ReservaVuelo/all', 'ReservaVueloController@index'); 
Route::get('/ReservaVuelo/show/{id}', 'ReservaVueloController@show'); 
Route::post('/ReservaVuelo/destroy/{id}', 'ReservaVueloController@destroy');
Route::post('/ReservaVuelo/store', 'ReservaVueloController@store');
Route::put('/ReservaVuelo/{reservaVuelo}', 'ReservaVueloController@update');
//ANIDADOS

Route::get('/Rol/all', 'RolController@index'); 
Route::get('/Rol/show/{id}', 'RolController@show'); 
Route::post('/Rol/destroy/{id}', 'RolController@destroy');
Route::post('/Rol/store', 'RolController@store');
Route::put('/Rol/{rol}', 'RolController@update');
//Anidados
Route::get('/Rol/{id}/all/User', 'RolController@rols'); 

Route::get('/Seguro/all', 'SeguroController@index'); 
Route::get('/Seguro/show/{id}', 'SeguroController@show'); 
Route::post('/Seguro/destroy/{id}', 'SeguroController@destroy');
Route::post('/Seguro/store', 'SeguroController@store');
Route::put('/Seguro/{seguro}', 'SeguroController@update');

Route::get('/Ubicacion/all', 'UbicacionController@index'); 
Route::get('/Ubicacion/show/{id}', 'UbicacionController@show'); 
Route::post('/Ubicacion/destroy/{id}', 'UbicacionController@destroy');
Route::post('/Ubicacion/store', 'UbicacionController@store');
Route::put('/Ubicacion/{ubicacion}', 'UbicacionController@update');

Route::get('/UsuarioMedioDePago/all', 'UsuarioMedioDePagoController@index'); 
Route::get('/UsuarioMedioDePago/show/{id}', 'UsuarioMedioDePagoController@show'); 
Route::post('/UsuarioMedioDePago/destroy/{id}', 'UsuarioMedioDePagoController@destroy');
Route::post('/UsuarioMedioDePago/store', 'UsuarioMedioDePagoController@store');
Route::put('/UsuarioMedioDePago/{usuarioMedioDePago}', 'UsuarioMedioDePagoController@update');

Route::get('/User/all', 'UserController@index'); 
Route::get('/User/show/{id}', 'UserController@show'); 
Route::post('/User/destroy/{id}', 'UserController@destroy');
Route::post('/User/store', 'UserController@store');
Route::put('/User/{usuarioMedioDePago}', 'UserController@update');

Route::get('/Vuelo/all', 'VueloController@index'); 
Route::get('/Vuelo/show/{id}', 'VueloController@show'); 
Route::post('/Vuelo/destroy/{id}', 'VueloController@destroy');
Route::post('/Vuelo/store', 'VueloController@store');
Route::put('/Vuelo/{vuelo}', 'VueloController@update');
Route::get('/Vuelo/agregarVuelo', 'VueloController@create');
//Anidados
Route::get('/Vuelo/{id}/all/Asiento', 'VueloController@asientos'); 
Route::get('/Vuelo/{id}/all/Asiento/disponibilidad', 'VueloController@asientosDisponibles'); 
Route::get('Vuelo', 'VueloController@vuelosOrigenDestino');


Auth::routes();

//CONTROLADORES QUE ESTAMOS USANDO PARA EL FRONT

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/habitacion/{id}', 'HabitacionController@habitaciones');

Route::get('/habitacion/reserva/{habitacion}', 'HabitacionController@habitacionReserva');

Route::get('/reservaVuelo/{id}', 'ReservaVueloController@reserva');

Route::get('Auto/see/{auto}', 'AutoController@vista');

Route::get('Actividad/reserva/{actividad}', 'ActividadController@vistaReserva');

Route::get('compra/{id}/', 'CompraController@comprarVuelo');

Route::get('compra-realizada/{id}/{name}/{dni}/{apellido}/{asiento}/{menor}/{asistencia}/{celular}/{pais}','CompraController@realizarCompra');

Route::get('compra-realizada/{id}/{name}/{dni}/{apellido}/{asiento}/{menor}/{asistencia}/{celular}/{pais}/{idU}','CompraController@realizarCompraVueloAuth');

Route::get('movimientos/{id}','UserController@movimientos');

Route::get('carrito-vuelo/{id}','ReservaVueloController@carritoCompraVuelo');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/compra-carro/{id}', 'CompraController@realizarCompraCarro');

Route::get('/compra-carro-realizada/{id}/{precio}', 'CompraController@compraCarro');

Route::get('/reserva-habitacion/{id}', 'HabitacionController@reservarHabitacion');

Route::get('/comprar-habitacion/{id}', 'CompraController@comprarHabitacion');

Route::get('/compra-habitacion-realizada/{id}/{precio}', 'CompraController@realizarCompraHabitacion');

Route::get('/carrito-habitacion/{id}', 'ReservaHabitacionController@carritoCompraHabitacion');