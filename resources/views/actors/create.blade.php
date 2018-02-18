@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Add actor</h3>
                <form method="post" action="{{ route('actors.store') }}">
                    {{ csrf_field() }}
                    @include('actors.partials.form', [
                        'name' => '',
                        'birthday' => '',
                        'deathday' => ''
                     ])
                    <input type="submit" class="btn btn-success" value="Create">
                </form>
            </div>
        </div>
    </div>
@endsection