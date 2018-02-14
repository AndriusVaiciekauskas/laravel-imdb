@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card bg-light mb-3">
                    <div class="card-header">{{ $category->name }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ $category->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection