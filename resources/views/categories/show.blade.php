@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card bg-light mb-3">
                    <div class="card-header">{{ $category->name }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ $category->description }}</p>
                        <hr>
                        <h4 class="mt-4">Movies in category</h4>
                        <ul class="list-group">
                            @foreach($category->movies as $movie)
                                <li class="list-group-item">
                                    <a href="{{ route('movies.show', $movie->id) }}">
                                        <img id="movie-img" class="img-fluid" img-fluid src="{{ $movie->featured_image }}" alt="actor image">
                                        {{ $movie->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <hr>

                        <h4 class="mt-4">Top actors in this category</h4>
                        <ul class="list-group">
                            @if ($actors !== null)
                                @foreach($actors as $actor)
                                    <li class="list-group-item">
                                        <a href="{{ route('actors.show', $actor->id) }}">
                                            <img id="movie-img" class="img-fluid" img-fluid src="{{ $actor->featured_image }}" alt="actor image">
                                            {{ $actor->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection