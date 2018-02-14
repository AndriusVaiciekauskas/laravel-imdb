@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if(isset($categories))
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a>
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </td>
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