<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([

    'middleware' => ['api', 'jwt.auth'],

], function() {

    Route::resource('companies', 'CompaniesController');
    Route::resource('employees', 'EmployeesController');
});

