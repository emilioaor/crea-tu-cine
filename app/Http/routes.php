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
//RUTAS INDEX
Route::get('/', ['uses' => 'IndexController@index', 'as' => 'index.index', 'middleware' => 'redirectCheckUser']);
Route::get('/login', ['uses' => 'IndexController@login', 'as' => 'index.login', 'middleware' => 'redirectCheckUser']);
Route::post('/login', ['uses' => 'IndexController@loginUser', 'as' => 'index.login.user', 'middleware' => 'redirectCheckUser']);
Route::post('/register', ['uses' => 'IndexController@registerUser', 'as' => 'index.register', 'middleware' => 'redirectCheckUser']);
Route::get('/logout', ['uses' => 'IndexController@logout', 'as' => 'index.logout', 'middleware' => 'onlyUserCheck']);
Route::get('/password-reset', ['uses' => 'IndexController@passwordReset', 'as' => 'index.password.reset', 'middleware' => 'redirectCheckUser']);
Route::post('/password-reset', ['uses' => 'IndexController@passwordResetStore', 'as' => 'index.password.reset.store', 'middleware' => 'redirectCheckUser']);
Route::get('/password-reset/{id}/{tmp}', ['uses' => 'IndexController@passwordToken', 'as' => 'index.password.reset.token', 'middleware' => 'redirectCheckUser']);
Route::put('/password-reset/{id}/{tmp}', ['uses' => 'IndexController@passwordTokenStore', 'as' => 'index.password.reset.token.store', 'middleware' => 'redirectCheckUser']);

//CAPTURA DE RUTA DE LA VIEJA APLICACION
Route::get('/{slug}','RedirectController@redirectMovie');

//RUTAS ZONA COMUN
Route::get('cine/all', ['uses' => 'MovieController@all', 'as' => 'cine.all']);

//RUTAS CINE
Route::group(['prefix' => '/cine/{user}'], function(){
    Route::get('/', ['uses' => 'CineController@index', 'as' => 'cine.user.index']);
    Route::get('/genre/{id}', ['uses' => 'CineController@indexGenre', 'as' => 'cine.user.genre']);
    Route::get('/create', ['uses' => 'CineController@create', 'as' => 'cine.user.create', 'middleware' => 'onlyCinemaAdmin']);
    Route::post('/create', ['uses' => 'CineController@store', 'as' => 'cine.user.store', 'middleware' => 'onlyCinemaAdmin']);
    Route::get('/admin', ['uses' => 'CineController@admin', 'as' => 'cine.user.admin', 'middleware' => 'onlyCinemaAdmin']);
    Route::get('/admin/genre/{id}', ['uses' => 'CineController@adminGenre', 'as' => 'cine.user.admin.genre', 'middleware' => 'onlyCinemaAdmin']);

    //RUTAS SHARE
    Route::get('/share', ['uses' => 'CineController@share', 'as' => 'cine.user.share']);

    //RUTAS CONFIG
    Route::get('/config', ['uses' => 'ConfigController@config', 'as' => 'cine.user.config', 'middleware' => 'onlyCinemaAdmin']);
    Route::put('/config', ['uses' => 'ConfigController@updateConfig', 'as' => 'cine.user.config.update', 'middleware' => 'onlyCinemaAdmin']);
    Route::post('/config/restore', ['uses' => 'ConfigController@restoreConfig', 'as' => 'cine.user.config.restore', 'middleware' => 'onlyCinemaAdmin']);
    Route::put('/config/password', ['uses' => 'ConfigController@changePassword', 'as' => 'cine.user.config.password', 'middleware' => 'onlyCinemaAdmin']);
    Route::put('/config/image/update', ['uses' => 'ConfigController@changeImage', 'as' => 'cine.user.config.image.update', 'middleware' => 'onlyCinemaAdmin']);

    //RUTAS MOVIES
    Route::group(['prefix' => '/movies'], function(){
        Route::get('/', ['uses' => 'MovieController@index', 'as' => 'cine.user.movies.index', 'middleware' => 'onlyCinemaAdmin']);
        Route::get('/create', ['uses' => 'MovieController@create', 'as' => 'cine.user.movies.create', 'middleware' => 'onlyCinemaAdmin']);
        Route::post('/create', ['uses' => 'MovieController@store', 'as' => 'cine.user.movies.store', 'middleware' => 'onlyCinemaAdmin']);
        Route::get('/{slug}', ['uses' => 'MovieController@show', 'as' => 'cine.user.movies.show']);
        Route::get('/{slug}/edit', ['uses' => 'MovieController@edit', 'as' => 'cine.user.movies.edit', 'middleware' => 'onlyCinemaAdmin']);
        Route::put('/{id}/update', ['uses' => 'MovieController@update', 'as' => 'cine.user.movies.update', 'middleware' => 'onlyCinemaAdmin']);
        Route::get('/{slug}/download/{id}', ['uses' => 'MovieController@download', 'as' => 'cine.user.movies.download']);
        Route::post('/{slug}/comment', ['uses' => 'MovieController@sendComment', 'as' => 'cine.user.movies.comment.send']);
        Route::post('/{slug}/like', ['uses' => 'MovieController@like', 'as' => 'cine.user.movies.like', 'middleware' => 'onlyUserCheck']);
    });

    //RUTAS RELATIONS
    Route::group(['prefix' => '/relation'], function() {
        Route::get('/', ['uses' => 'RelationController@index', 'as' => 'cine.user.relation.index', 'middleware' => 'onlyCinemaAdmin']);
        Route::post('/create', ['uses' => 'RelationController@store', 'as' => 'cine.user.relation.store', 'middleware' => 'onlyCinemaAdmin']);
        Route::put('id/update', ['uses' => 'RelationController@update', 'as' => 'cine.user.relation.update', 'middleware' => 'onlyCinemaAdmin']);
    });
});

