<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }} " />
    <title>Page - @yield('title')</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container mt-4">
                <div>
                    <a href="/home" class="navbar-brand" style="color: gray">Home</a>
                    <a href="/companies" class="btn btn-outline-secondary mr-4 ml-4">Company</a>
                    <a href="/employees" class="btn btn-outline-secondary">Employee</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <button class="btn btn-link">Log out</button>
                </form>
            </div>
        </nav>
        <hr />
    </header>

    <main class="container">
        @yield('content')
    </main>
    
</body>
</html>