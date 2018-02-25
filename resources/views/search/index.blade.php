@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <h2>Search results for movies</h2>
                @if(count($movies) == 0)
                    <p>0 results found</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Movie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($movies as $movie)
                                <tr>
                                    <td>
                                        <a class="float-left" href="{{ route('actors.show', $movie->id) }}">
                                            <img id="actor-img" class="img-fluid" src="{{ $movie->featured_image }}">
                                            {{ $movie->name }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-10 mx-auto">
                <h2>Search results for actors</h2>
                @if(count($actors) == 0)
                    <p>0 results found</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Actor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actors as $actor)
                                <tr>
                                    <td>
                                        <a class="float-left" href="{{ route('actors.show', $actor->id) }}">
                                            <img id="actor-img" class="img-fluid" src="{{ $actor->featured_image }}">
                                            {{ $actor->name }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection