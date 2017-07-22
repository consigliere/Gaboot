<?php
/**
 * web.php
 * Created by @anonymoussc on 6/27/2017 12:26 PM.
 */

Route::group(['middleware' => 'web', 'prefix' => 'gaboot', 'namespace' => 'App\Components\Gaboot\Http\Controllers'], function () {
    Route::get('/', 'GabootController@index');
});