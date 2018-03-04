@extends('layouts.admin', ['title' => 'Actors'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.success')
                @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                    <div>
                        <a href="{{ route('actors.create') }}" class="btn btn-success">Add new actor</a>
                        <form class="form-inline pull-right mb-2" action="{{ route('search.actors') }}" method="post">
                            {{ csrf_field() }}
                            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 search-btn" type="submit">Search</button>
                        </form>
                    </div>
                @endif
                @if(isset($actors))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Deathday</th>
                            @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($actors as $actor)
                            <tr>
                                <td>
                                    <a href="{{ route('actors.show', $actor->id) }}">
                                        <img id="actor-img" src="{{ $actor->featured_image }}">
                                        {{ $actor->name }}
                                    </a>
                                </td>
                                <td>{{ $actor->birthday }}</td>
                                <td>{{ $actor->deathday }}</td>
                                @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                    <td>
                                        <form method="post" action="{{ route('actors.destroy', $actor->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="{{ route('actors.edit', $actor->id) }}" class="btn btn-info">Edit</a>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No categories yet</h4>
                @endif
                <div class="text-center">
                    {{ $actors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection