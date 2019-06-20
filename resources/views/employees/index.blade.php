@extends('layouts.main')

@section('title', 'Employee')


@section('content')

<h2>Employee</h2>

    <table class="table table-hover table-striped table-border">
        <thead>
            <tr>
                <td class="td-brand">First Name</td>
                <td class="td-brand">Last Name</td>
                <td class="td-brand">Company ID</td>
                <td class="td-brand">Email</td>
                <td class="td-brand">Phone</td>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->company_id }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <div class="d-flex">
                        <td><a href="/employees/{{$employee->id}}">View</a></td>
                        <td><a href="/employees/{{$employee->id}}/edit">Edit</a></td>
                        <td><form method="POST" action="/employees/{{$employee->id}}" onsubmit="foo(event)">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link" style="margin:0; padding:0">Delete</button>
                        </form></div>
                        <script>
                            function foo(event) {
                              if (!confirm('Are you sure?')) {
                                  event.preventDefault();
                              }
                            }
                        </script>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/employees/create" class="btn btn-outline-secondary mt-4">Create employee</a>
    <div class="d-flex justify-content-center nav-cont">{{ $employees->links() }}</div>
@endsection