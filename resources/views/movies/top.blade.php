@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Movie</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movies as $movie)
                            <tr>
                                <td>
                                    <a class="float-left" href="{{ route('movies.show', $movie->id) }}">
                                        <img id="actor-img" class="img-fluid" src="{{ $movie->featured_image }}">
                                        {{ $movie->name }}
                                    </a>
                                </td>
                                <td>{{ $movie->rating }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection