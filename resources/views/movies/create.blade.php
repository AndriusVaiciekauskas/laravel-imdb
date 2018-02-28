@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Add movie</h3>
                <form method="post" action="{{ route('movies.store') }}">
                    {{ csrf_field() }}
                    @include('movies.partials.form', [
                        'name' => '',
                        'description' => '',
                        'release_date' => '',
                        'rating' => '',
                        'category' => ''
                     ])
                    <input type="submit" class="btn btn-success" value="Create">
                </form>
            </div>
        </div>
    </div>
@endsection