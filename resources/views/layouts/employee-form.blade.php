@extends('layouts.main')

@section('title', 'Employee')

@section('content')

    @if(count($companies) !== 0)

        <form method="POST" action="/employees/@yield('path')" class="form-container">

            @csrf

            @if(isset($employee))
                @method('PUT')
                <input name="id" type="text" value="{{$employee->id}}" hidden/>
            @endif

            <div class="form-group">
                <label for="first-name">First Name: </label>
                <input class="form-control" id="first-name" name="first_name" type="text" 
                    value="@if(old('first_name')){{old('first_name')}} @elseif(isset($employee)){{$employee->first_name}} @endif" required/>
            </div>

            @if($errors->has('first_name'))
                <div class="form-group">
                    @foreach($errors->get('first_name') as $message)
                        <p style="color: red">{{$message}}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label for="last-name">Last name: </label>
                <input class="form-control" id="last-name" name="last_name" type="text" 
                    value="@if(old('last_name')){{old('last_name')}} @elseif(isset($employee)){{$employee->last_name}} @endif" required/>
            </div>

            @if($errors->has('last_name'))
                <div class="form-group">
                    @foreach($errors->get('last_name') as $message)
                        <p style="color: red">{{$message}}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label for="company-id">Company</label>
                <select name="company_id" class="form-control" id="company-id">
                    @if(!old('company_id') && !isset($employee))
                        <option disabled selected value hidden>Choose Company</option>
                    @endif
                    @foreach($companies as $company)
                        @if(old('company_id'))
                            <option value="{{$company->id}}" @if(old('company_id')==$company->id) selected @endif>{{$company->name}}</option>
                        @elseif(isset($employee))
                            <option value="{{$company->id}}" @if($employee->company_id==$company->id) selected @endif>{{$company->name}}</option>
                        @else
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if($errors->has('company_id'))
                <div class="form-group">
                    @foreach($errors->get('company_id') as $message)
                        <p style="color: red">{{$message}}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label for="mail">Email: </label>
                <input class="form-control" id="mail" name="email" type="email" 
                    value="@if(old('email')){{old('email')}} @elseif(isset($employee)){{$employee->email}} @endif" 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
            </div>

            @if($errors->has('email'))
                <div class="form-group">
                    @foreach($errors->get('email') as $message)
                        <p style="color: red">{{$message}}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label for="phone">Phone: </label>
                <input class="form-control" id="phone" name="phone" type="tel" 
                    value="@if(old('phone')){{old('phone')}} @elseif(isset($employee)){{$employee->phone}} @endif"/>
            </div>

            @if($errors->has('phone'))
                <div class="form-group">
                    @foreach($errors->get('phone') as $message)
                        <p style="color: red">{{$message}}</p>
                    @endforeach
                </div>
            @endif

            <button class="btn btn-outline-primary">@yield('action')</button>
            <a href="/employees" class="btn btn-outline-warning">Cancel</a>

        </form>

    @else 
        <h2>Companies do not exist. First create a company</h2>
    @endif

@endsection