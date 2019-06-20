<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([ 'register'  =>  false ]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::resource('companies', 'CompaniesController');
    Route::resource('employees', 'EmployeesController');
});

