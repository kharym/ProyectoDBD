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

Route::get('/Habitacion/all', 'HabitacionController@index'); 
Route::get('/Habitacion/show/{id}', 'HabitacionController@show'); 

Route::post('/Habitacion/destroy/{id}', 'HabitacionController@destroy');
Route::get('/Habitacion/store', 'HabitacionController@store');  


