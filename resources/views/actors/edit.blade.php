@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <h3>Edit actor</h3>
                <form method="post" action="{{ route('actors.update', $actor->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    @include('actors.partials.form', [
                        'name' => $actor->name,
                        'birthday' => $actor->birthday,
                        'deathday' => $actor->deathday
                     ])
                    <input type="submit" class="btn btn-success" value="Edit">
                </form>
            </div>
        </div>
    </div>
@endsection