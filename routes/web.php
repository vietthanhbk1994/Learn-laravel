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
    
    Route::get('/home', [
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

    Route::get('/{author?}', [
        'uses'  => 'QuoteController@getIndex',
        'as'    =>  'index'
    ]);
    Route::post('/new', [
        'uses'  => 'QuoteController@postQuote',
        'as'    =>  'create'
    ]);
    Route::get('/delete/{quote_id}', [
        'uses'  => 'QuoteController@getDeleteQuote',
        'as'    =>  'delete'
    ]);
});