@extends('layouts.main')

@section('title', 'Company')

@section('content')

<h2>Company</h2>

    <table class="table table-hover table-striped table-border">
        <thead>
            <tr>
                <td class="td-brand">Logo</td>
                <td class="td-brand">Name</td>
                <td class="td-brand">Email</td>
                <td class="td-brand">Website</td>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>
                        <img src="storage/logos/{{$company->logo?$company->logo:'default-logo.png'}}" alt="" style="width: 50px"/>
                    </td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <div class="d-flex">
                        <td><a href="/companies/{{$company->id}}">View</a></td>
                        <td><a href="/companies/{{$company->id}}/edit">Edit</a></td>
                        <td><form method="POST" action="/companies/{{$company->id}}" onsubmit="foo(event)">
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
    <a href="/companies/create" class="btn btn-outline-secondary mt-4">Create company</a>
    <div class="d-flex justify-content-center nav-cont">{{ $companies->links() }}</div>
@endsection