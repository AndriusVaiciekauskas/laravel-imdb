@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-4 mx-auto card p-4 mt-5">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h2>File upload</h2>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="col-6 btn btn-secondary" id="actor_label">
                        <input type="radio" name="options" id="actor" autocomplete="off" checked> Actor
                    </label>
                    <label class="col-6 btn btn-secondary" id="movie_label">
                        <input type="radio" name="options" id="movie" autocomplete="off"> Movie
                    </label>
                </div>

                <form id="actor_form" method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group mt-3">
                        <label>File</label>
                        @include('images.partials.errors', ['name' => 'image'])
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="imagable_type" type="hidden" value="App\Actor">
                    </div>
                    <div class="form-group mt-3">
                        <label>Select Actor</label>
                        <select class="custom-select" name="imagable_id">
                            @foreach($actors as $actor)
                                <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="col-12 btn btn-dark" value="Upload">
                    </div>
                </form>

                <form id="movie_form" method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group mt-3">
                        <label for="exampleFormControlFile1">File</label>
                        @include('images.partials.errors', ['name' => 'image'])
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="imagable_type" type="hidden" value="App\Movie">
                    </div>
                    <div class="form-group mt-3">
                        <label>Select Movie</label>
                        <select class="custom-select" name="imagable_id">
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="col-12 btn btn-dark" value="Upload">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection