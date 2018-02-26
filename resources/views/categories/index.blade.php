@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 card bg-light">
                <h2>Categories</h2>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <a href="{{ route('categories.show', $category->id) }}">
                                {{ $category->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection