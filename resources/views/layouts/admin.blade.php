<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
<div class="container-fluid" id="wrapper">
    <div class="row">
        <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
            <h1 class="site-title"><a href="{{ route('home') }}"><i class="fa fa-2x fa-imdb"></i>IMDB</a></h1>

            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>

            <ul class="nav nav-pills flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.movies') }}"><i class="fa fa-film"></i> Movies <span class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.actors') }}"><i class="fa fa-user"></i> Actors</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories') }}"><i class="fa fa-list-ul"></i> Categories</a></li>
            </ul>

            <a href="{{ route('home') }}" class="logout-button"><i class="fa fa-long-arrow-left"></i> Back to main page</a></nav>

        <main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
            <header class="page-header row justify-center">
                <div class="col-md-6 col-lg-8" >
                    <h1 class="float-left text-md-left">{{ $title }}</h1>
                </div>

                <div class="clear"></div>
            </header>

            <section class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </section>
        </main>
    </div>
</div>
</body>
</html>
