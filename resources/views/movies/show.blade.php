@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card bg-light mb-3">
                    <div class="card-header">{{ $movie->name }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ $movie->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection