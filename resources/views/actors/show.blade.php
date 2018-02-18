@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto bg-dark text-white">
                <div class="row mt-4">
                    <div class="col-sm-4">
                        @if(isset($image))
                            <img class="img-fluid" img-fluid src="{{ asset('uploadedimages/' . $image->filename) }}" alt="actor image">
                        @else
                            <img class="img-fluid" img-fluid src="http://suiteapp.com/c.3857091/shopflow-1-03-0/img/no_image_available.jpeg" alt="actor image">
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <h2>{{ $actor->name }}</h2>
                        <p><b>Date of birth:</b> {{ $actor->birthday }}</p>
                        <h4>Photos</h4>
                        <div class="row">
                            @foreach($images as $image)
                                <div class="col-sm-3">
                                    <img id="image-show" class="img-fluid img-thumbnail" img-fluid src="{{ asset('uploadedimages/' . $image->filename) }}" alt="actor image">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="mt-4">Movies</h3>
                        <ul class="list-group text-dark my-4">
                            @foreach($actor->movies as $movie)
                                <li class="list-group-item">
                                    <a href="{{ route('movies.show', $movie->id) }}">
                                        <img id="movie-img" src="{{ asset('uploadedimages/' . $movie->images()->first()->filename) }}">
                                        {{ $movie->name }}
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