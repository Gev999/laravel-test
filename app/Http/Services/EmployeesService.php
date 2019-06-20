<?php

namespace App\Http\Services;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class EmployeesService 
{

    public static function create() 
    {
        return view('employees.create', [ 'companies' => Company::all() ]);
    }

    public static function storeData($request) 
    {
        $employee = new Employee;
        self::addData($employee, $request);
    }

    public static function showEmployee($id)
    {
        $employee = Employee::find($id);
        return $employee? view('employees.show', [ 'employee' => $employee ]) : redirect()->action('EmployeesController@index');
    }

    public static function showEmployees()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', [ 'employees' => $employees ]);
    }

    public static function editEmployee($id)
    {
        $employee = Employee::find($id);
        return $employee? view('employees.edit', [ 'employee' => $employee, 'companies' => Company::all() ]) : redirect()->action('EmployeesController@index');
    }

    public static function updateData($request, $id)
    {

        $employee = Employee::find($id);
        if ($employee) {
            self::addData($employee, $request);
        }
    }

    public static function destroyEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return true;
    }

    private static function addData($employee, $request)
    {
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->save();
        return true;
    }
}