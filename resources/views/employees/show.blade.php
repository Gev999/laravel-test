@extends('layouts.main')

@section('title', 'Employee')

@section('content')

<h2>Employee</h2>

<table class="table table-hover table-striped table-border">
        <thead>
            <tr>
                <td class="td-brand">First Name</td>
                <td class="td-brand">Last Name</td>
                <td class="td-brand">employee ID</td>
                <td class="td-brand">Email</td>
                <td class="td-brand">Phone</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->company_id }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
            </tr>
        </tbody>
    </table>

@endsection