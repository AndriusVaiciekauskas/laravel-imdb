@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto bg-dark text-white">
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <img class="img-fluid" img-fluid src="{{ $actor->featured_image }}" alt="actor image">

                    </div>
                    <div class="col-sm-8">
                        <div>
                            <h2>{{ $actor->name }}</h2>
                        </div>
                        <p><b>Date of birth:</b> {{ $actor->birthday }}</p>
                        <h4>Photos</h4>
                        <div class="row">
                            @foreach($img as $image)
                                <div class="col-sm-3">
                                    @if ($image != null)
                                        <img id="image-show" class="img-fluid img-thumbnail" img-fluid src="{{ asset('storage/images/' . $image->filename) }}" alt="actor image">
                                    @endif
                                    @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                        <form action="{{ route('delete.image', ['image_id' => $image->id, 'actor_id' => $actor->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" value="X" class="btn-sm btn-danger" id="delete-button">
                                        </form>

                                        <form action="{{ route('actors.featured', ['image_id' => $image->id, 'actor_id' => $actor->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input type="submit" value="F" class="btn-sm btn-success" id="featured-image">
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if(Auth::user())
                                    <form class="form-inline mt-3" id="actor_form" method="post" action="{{ route('store.actor.image', $actor->id) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group mt-3">
                                            @include('actors.partials.errors', ['name' => 'image'])
                                            <input type="file" class="form-control-file" name="image">
                                        </div>
                                        <div class="form-group">
                                            <select name="movie_id" class="form-control">
                                                <option value="">Choose movie</option>
                                                @foreach($actor->movies as $movie)
                                                    <option value="{{ $movie->id }}">{{ $movie->name }}</option>
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
                        <h3 class="mt-4">Movies</h3>
                        <ul class="list-group text-dark my-4">
                            @foreach($actor->movies as $movie)
                                <li class="list-group-item">
                                    <a class="float-left" href="{{ route('movies.show', $movie->id) }}">
                                        <img id="movie-img" class="img-fluid" img-fluid src="{{ $movie->featured_image }}" alt="actor image">
                                        {{ $movie->name }}
                                    </a>
                                    <form action="{{ route('detach.movie', ['actor_id' => $actor->id, 'movie_id' => $movie->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" name="detach-movie" class="btn-sm btn-danger float-right" value="Remove">
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection