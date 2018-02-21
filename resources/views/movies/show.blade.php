@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto bg-dark text-white">
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <img class="img-fluid" src="{{ $movie->featured_image }}" alt="actor image">
                    </div>
                    <div class="col-sm-8">
                        <h2>{{ $movie->name }} <small>({{ $movie->year }})</small></h2>
                        <p><b>Category:</b> <a href="{{ route('categories.show', $movie->category->id) }}">{{ $movie->category->name }}</a></p>
                        <p><b>Description:</b></p>
                        <p>{{ $movie->description }}</p>
                        <h4>Photos</h4>
                        <div class="row">
                            @foreach($img as $image)
                                <div class="col-sm-3">
                                    <img id="image-show" class="img-fluid img-thumbnail" img-fluid src="{{ asset('storage/images/' . $image->filename) }}" alt="actor image">
                                    @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                        <form action="{{ route('delete.image.movie', $image->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" value="X" class="btn-sm btn-danger" id="delete-button">
                                        </form>

                                        <form action="{{ route('movies.featured', $image->id) }}" method="post">
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
                            @foreach($movie->actors as $actor)
                                <li class="list-group-item">
                                    <a href="{{ route('actors.show', $actor->id) }}">
                                        {{--<img id="actor-img" src="{{ $actor->featured_image }}">--}}
                                        {{ $actor->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection