@extends('layouts.admin', ['title' => 'Categories'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif
                @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                    <a href="{{ route('categories.create') }}" class="btn btn-success mb-2">Add new category</a>
                @endif
                @if(isset($categories))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                <th>Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr id="category-row">
                                <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                                <td>{{ $category->description }}</td>
                                @if(Auth::user() !== null && Auth::user()->role == 'Admin')
                                    <td>
                                        <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a>
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