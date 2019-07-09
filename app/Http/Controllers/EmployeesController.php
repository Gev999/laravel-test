<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\CheckEmployeeData;
use App\Http\Services\EmployeesService;

class EmployeesController extends Controller
{


    //--------------------------------------------------
    public function index2() {
        return Employee::all()->toJson();
    }

    public function store2(CheckEmployeeData $request) {
        $employee = new Employee;
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->save();
        return response()->json('Employee added succesfully');
    }

    public function update2(CheckEmployeeData $request, $id) {
        $employee = Employee::find($id);
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->update();
        return response()->json('Employee updated succesfully');
    }

    public function destroy2($id) {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json('Employee deleted succesfully');
    }

    public function show2($id) {
        $employee = Employee::find($id);
        if ($employee) {
            return $employee->toJson();
        }
        return response()->json([
            'error' => 'Employee with such id does not exist',
        ], 404);
    }

    //--------------------------------------------------
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