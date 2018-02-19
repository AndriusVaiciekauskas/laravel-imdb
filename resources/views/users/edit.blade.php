@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Edit user</h3>
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('name', $user->email) }}">
                    <label>Name</label>
                    <select class="form-control" name="role">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                    <input type="submit" class="btn btn-success" value="Edit">
                </form>
            </div>
        </div>
    </div>
@endsection