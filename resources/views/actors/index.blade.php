@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
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
            </div>
        </div>
    </div>
@endsection