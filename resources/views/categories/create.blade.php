@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Create category</h3>
                <form method="post" action="{{ route('categories.store') }}">
                    {{ csrf_field() }}
                    @include('categories.partials.form', ['name' => '', 'description' => ''])
                    <input type="submit" class="btn btn-success" value="Create">
                </form>
            </div>
        </div>
    </div>
@endsection