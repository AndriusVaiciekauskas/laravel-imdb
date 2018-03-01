@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 card bg-dark">
                <h2 class="text-white">Latest movies</h2>
                <div class="row">
                    @foreach($movies as $movie)
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <a href="{{ route('movies.show', $movie->id) }}">
                                <img id="image-front" class="img-fluid" img-fluid src="{{ $movie->featured_image }}" alt="actor image">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-1">
                        <a class="badge badge-secondary mb-3" href="{{ route('categories') }}">See more</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 card popular">
                <h5 class="mt-3">Popular movies</h5>
                <ul class="list-unstyled">
                    @foreach($popular_movies as $movie)
                        <li><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->name }}</a></li>
                    @endforeach
                </ul>
                <hr>
                <h5 class="mt-3">Popular actors</h5>
                <ul class="list-unstyled">
                    @foreach($popular_actors as $actor)
                        <li><a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
