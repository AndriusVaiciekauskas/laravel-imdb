@extends('layouts.admin', ['title' => 'Movies'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif
                @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                    <div>
                        <a href="{{ route('movies.create') }}" class="btn btn-success mb-2">Add new movie</a>
                        <form class="form-inline pull-right mb-2" action="{{ route('search.movies') }}" method="post">
                            {{ csrf_field() }}
                            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 search-btn" type="submit">Search</button>
                        </form>
                    </div>
                @endif
                @if(isset($movies))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Movie</th>
                            <th>Year</th>
                            <th>Rating</th>
                            <th>Category</th>
                            @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movies as $movie)
                            <tr>
                                <td>
                                    <a href="{{ route('movies.show', $movie->id) }}">
                                        <img id="movie-img" class="img-fluid" img-fluid src="{{ $movie->featured_image }}" alt="actor image">
                                        {{ $movie->name }}
                                    </a>
                                </td>
                                <td>{{ $movie->year }}</td>
                                <td>{{ number_format($movie->ratings->avg('rating'), 1) }}</td>
                                <td>{{ $movie->category->name }}</td>
                                @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                    <td>
                                        <form method="post" action="{{ route('movies.destroy', $movie->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-info">Edit</a>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No categories yet</h4>
                @endif
            </div>
        </div>
    </div>
@endsection