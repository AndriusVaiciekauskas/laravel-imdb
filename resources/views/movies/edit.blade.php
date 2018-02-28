@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Edit movie</h3>
                <form method="post" action="{{ route('movies.update', $movie->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    @include('movies.partials.form', [
                        'name' => $movie->name,
                        'description' => $movie->description,
                        'release_date' => $movie->release_date,
                        'rating' => $movie->rating,
                        'category' => $movie->category_id
                     ])
                    <input type="submit" class="btn btn-success" value="Edit">
                </form>
            </div>
        </div>
    </div>
@endsection