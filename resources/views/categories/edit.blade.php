@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Edit category</h3>
                <form method="post" action="{{ route('categories.update', $category->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    @include('categories.partials.form', ['name' => $category->name, 'description' => $category->description])
                    <input type="submit" class="btn btn-success" value="Edit">
                </form>
            </div>
        </div>
    </div>
@endsection