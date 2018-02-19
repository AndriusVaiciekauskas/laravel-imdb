@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif
                @if(isset($movies))
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Movie</th>
                                <th>Description</th>
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
                                    <td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->name }}</a></td>
                                    <td>{{ $movie->description }}</td>
                                    <td>{{ $movie->year }}</td>
                                    <td>{{ $movie->rating }}</td>
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