@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection