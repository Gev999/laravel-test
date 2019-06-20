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
            <tr>
                <td>
                    <img src="/storage/logos/{{$company->logo?$company->logo:'default-logo.png'}}" alt="" style="width: 50px"/>
                </td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->website }}</td>
            </tr>
        </tbody>
    </table>
@endsection
