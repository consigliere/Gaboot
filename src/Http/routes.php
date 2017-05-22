<?php

Route::group(['middleware' => 'web', 'prefix' => 'gaboot', 'namespace' => 'App\\Components\Gaboot\Http\Controllers'], function() {
    Route::get('/', 'GabootController@index');
    Route::get('/oauth2', 'GabootController@oauth2')->middleware('admin.user');
});

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });
});