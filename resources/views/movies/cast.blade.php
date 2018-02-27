@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto bg-dark text-white">
                <div class="row mt-4">
                    <div class="col-sm-12">
                        <h2>
                            <img class="img-fluid cast-image" src="{{ $movie->featured_image }}" alt="actor image">
                            {{ $movie->name }}
                            <small>({{ $movie->year }})</small>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                        <h3 class="mt-4">Cast</h3>
                        <ul class="list-group text-dark my-4">
                            @foreach($actors as $actor)
                                <li class="list-group-item">
                                    <a class="float-left" href="{{ route('actors.show', $actor->id) }}">
                                        <img id="actor-img" class="img-fluid" src="{{ $actor->featured_image }}">
                                        {{ $actor->name }}
                                    </a>
                                    @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                        <form action="{{ route('detach.actor', ['movie_id' => $movie->id, 'actor_id' => $actor->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" name="detach-movie" class="btn-sm btn-danger float-right" value="Remove">
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection