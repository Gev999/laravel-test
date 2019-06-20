<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CheckEmployeeData;
use App\Http\Services\EmployeesService;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeesService::showEmployees();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return EmployeesService::create();
    }

    public function store(CheckEmployeeData $request)
    {
        EmployeesService::storeData($request);
        return redirect()->action('EmployeesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return EmployeesService::showEmployee($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return EmployeesService::editEmployee($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckEmployeeData $request, $id)
    {
        EmployeesService::updateData($request, $id);
        return redirect()->action('EmployeesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmployeesService::destroyEmployee($id);
        return redirect()->action('EmployeesController@index');
    }
}