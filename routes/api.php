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

    Route::get('companies', 'CompaniesController@index2');
    Route::get('companies/{id}', 'CompaniesController@show2');
    Route::delete('companies/{id}', 'CompaniesController@destroy2');
    Route::post('companies', 'CompaniesController@store2');
    Route::put('companies/{id}', 'CompaniesController@update2');

    Route::get('employees', 'EmployeesController@index2');
    Route::get('employees/{id}', 'EmployeesController@show2');
    Route::delete('employees/{id}', 'EmployeesController@destroy2');
    Route::post('employees', 'EmployeesController@store2');
    Route::put('employees/{id}', 'EmployeesController@update2');
});

