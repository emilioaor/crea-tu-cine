<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Rutas Index
Route::get('/','indexController@index');
Route::get('/{id}/video/{video}','indexController@video');
Route::get('/{slug}','indexController@movie');
Route::post('/subscriber/add','indexController@suscription');
Route::get('/download/{id}','indexController@download');
Route::get('/subscriber/agradecimientos','indexController@graxx');
Route::get('/error/404','indexController@error404');

//Rutas Generos
Route::get('genero/{genero}','genreController@index');

// Rutas de Autorizacion
Route::get('auth/login','authController@login')->middleware('checkAuth');
Route::post('auth/authenticate','authController@authenticate')->middleware('checkAuth');
Route::get('auth/logout','authController@logoutuser');

// Rutas Administrador
Route::group(['prefix'	=> 'admin','middleware' => 'admin'],function(){
	Route::resource('movies','moviesController');
	Route::get('fast/update','moviesController@fast');
	Route::resource('genres','adminGenreController');
	Route::resource('relations','relationsController');
	Route::get('subscribers','subscribersController@index');
});
