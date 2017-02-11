<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => ['web']], function() {
    
    Route::get('/', [
        'uses'  => 'NiceActionController@getHome',
        'as'    => 'home'
    ]);

    Route::group(['prefix' => 'do'], function() {
        Route::get('/{action}/{name?}', [
            'uses'  => 'NiceActionController@getNiceAction',
            'as'    => 'niceaction'
        ]);

        Route::post('/add_action', [
            'uses'  => 'NiceActionController@postInsertNiceAction',
            'as'    => 'add_action'
        ]);
    });
});