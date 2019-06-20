@extends('layouts.main')

@section('title', 'Company')

@section('content')

<form method="POST" action="/companies/@yield('path')" class="form-container" enctype="multipart/form-data">

    @csrf

    @if(isset($company))
        @method('PUT')
        <input type="text" name="id" value={{$company->id}} hidden/>
    @endif

    <div class="form-group">
        <label for="logo">Logo: </label>
        <img src="@if(isset($company))/storage/logos/{{$company->logo?$company->logo:'default-logo.png'}} @else # @endif"
            class="ml-2 mt-4 mb-4" alt="" style="width: 50px" id="blah"/>
        <br />
        <input type='file' id="logo" name="logo" accept="image/*" />
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/script.js') }} "></script>

    @if($errors->has('logo'))
        <div class="form-group">
            @foreach($errors->get('logo') as $message)
                <p style="color: red">{{$message}}</p>
            @endforeach
        </div>
    @endif

    <div class="form-group">
        <label for="name">Company name: </label>
        <input class="form-control" id="name" name="name" type="text" 
            value="@if(old('name')){{old('name')}} @elseif(isset($company)){{$company->name}} @endif" required/>
    </div>

    @if($errors->has('name'))
        <div class="form-group">
            @foreach($errors->get('name') as $message)
                <p style="color: red">{{$message}}</p>
            @endforeach
        </div>
    @endif

    <div class="form-group">
        <label for="mail">Email: </label>
        <input class="form-control" id="mail" name="email" type="email" 
            value="@if(old('email')){{old('email')}} @elseif(isset($company)){{$company->email}} @endif" 
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
        <label for="website">Website: </label>
        <input class="form-control" id="website" name="website" type="text" 
            value="@if(old('website')){{old('website')}} @elseif(isset($company)){{$company->website}} @endif"/>
    </div>

    <button class="btn btn-outline-primary">@yield('action')</button>
    <a href="/companies" class="btn btn-outline-warning">Cancel</a>

</form>

@endsection