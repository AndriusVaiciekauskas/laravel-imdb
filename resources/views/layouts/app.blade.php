<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IMDB') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'IMDB') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ route('movies.top') }}">Top movies</a></li>
                        <li><a class="nav-link" href="{{ route('categories') }}">Categories</a></li>
                        <form action="{{ route('search') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-inline">
                                <input type="hidden" id="route" name="route" value="{{ route('suggest') }}">
                                <input class="form-control mr-sm-2 search" type="text" name="search" placeholder="Search" aria-label="Search" autocomplete="off">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </div>
                            <ul class="list-unstyled card" id="suggestion"></ul>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            <li><a title="Login with Facebook" class="nav-link fb-icon" href="{{ route('facebook.redirect') }}"><i class="fa fa-2x fa-facebook-square"></i></a></li>
                        @else
                            @if(Auth::user()->role == 'Admin')
                                    <li><a class="nav-link" href="{{ route('admin.movies') }}">Admin</a></li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            if (window.location.href.indexOf('#_=_') > 0) {
                window.location = window.location.href.replace(/#.*/, '');
            }
        });
    </script>
</body>
</html>
