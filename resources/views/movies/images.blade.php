@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.success')
            </div>
            <div class="col-sm-12">
                <h2>All images <a class="btn btn-success" href="{{ route('movies.show', $movie->id) }}">Back to movie</a></h2>
            </div>
            @foreach($images as $image)
                <div class="col-sm-3">
                    <img id="image-show" class="img-fluid img-thumbnail" img-fluid src="{{ $image->image->small_image }}" alt="actor image">
                    @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                        <form action="{{ route('delete.image.movie', ['image_id' => $image->image->id, 'movie_id' => $movie->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="submit" value="X" class="btn-sm btn-danger" id="delete-button">
                        </form>
                        <form action="{{ route('movies.featured', ['image_id' => $image->image->id, 'movie_id' => $movie->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="submit" value="F" class="btn-sm btn-success" id="featured-image">
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection