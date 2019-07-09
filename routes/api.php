<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([

    'middleware' => ['api', 'jwt.auth'],

], function() {

    Route::get('companies', 'CompaniesController@index2');
    Route::get('companies/{id}', 'CompaniesController@show2');
    Route::delete('companies/{id}', 'CompaniesController@delete2');
    Route::post('companies', 'CompaniesController@store2');
    Route::put('companies/{id}', 'CompaniesController@update2');
    Route::get('test', 'CompaniesController@test');
});

