@inject('voted', 'App\Services\HasVotedService')
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto bg-dark text-white">
                <div class="mt-4">
                    @include('partials.success')
                </div>
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <img class="img-fluid" src="{{ $movie->featured_image }}" alt="actor image">
                    </div>
                    <div class="col-sm-8 movie">
                        <h2>
                            {{ $movie->name }}
                            <small>({{ $movie->year }})</small>
                            @if(Auth::user() && !$voted->hasVoted(Auth::user(), $movie))
                                <form class="form-inline float-right" action="{{ route('movies.rate', $movie->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group input-group-sm mr-1">
                                        <select name="rating" class="form-control">
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn-sm btn-light" value="Rate!">
                                    </div>
                                </form>
                            @endif
                        </h2>
                        <p>
                            <b>Rating:</b>
                            @if($movie->rating != 0)
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $movie->rating * 10 }}%" aria-valuenow="{{ $movie->rating * 10 }}" aria-valuemin="0" aria-valuemax="100">{{ $movie->rating }}</div>
                                </div>
                                <small>Votes:({{ $movie->votes }})</small>
                            @else
                                Not rated yet!
                            @endif
                        </p>
                        <p><b>Category:</b> <a href="{{ route('categories.show', $movie->category->id) }}">{{ $movie->category->name }}</a></p>
                        <p><b>Description:</b></p>
                        <p>{{ $movie->description }}</p>
                        <h4>Photos</h4>
                        <div class="row">
                            @foreach($img as $image)
                                <div class="col-6 col-sm-3">
                                    <img id="image-show" class="img-fluid img-thumbnail" img-fluid src="{{ $image->small_image }}" alt="actor image">
                                    @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                        <form action="{{ route('delete.image.movie', ['image_id' => $image->id, 'movie_id' => $movie->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" value="X" class="btn-sm btn-danger" id="delete-button">
                                        </form>

                                        <form action="{{ route('movies.featured', ['image_id' => $image->id, 'movie_id' => $movie->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input type="submit" value="F" class="btn-sm btn-success" id="featured-image">
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                            @if(count($img) >= 4)
                                <a class="btn-link" href="{{ route('movies.images', $movie->id) }}"><small>See all images</small></a>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if(Auth::user())
                                    <form class="form-inline mt-3" id="actor_form" method="post" action="{{ route('store.movie.image', $movie->id) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group mt-3">
                                            @include('movies.partials.errors', ['name' => 'image'])
                                            <input type="file" class="form-control-file" name="image">
                                        </div>
                                        <div class="form-group">
                                            <select name="actor_id" class="form-control">
                                                <option value="">Choose actor</option>
                                                @foreach($actors as $actor)
                                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Upload">
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
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
                        @if(count($movie->actors) > 10)
                            <a class="btn-link" href="{{ route('movies.cast', $movie->id) }}">See full cast...</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection