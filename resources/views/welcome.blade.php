@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12 card bg-info">
                    <h2>Latest movies</h2>
                    <div class="row">
                        @for($i = 0; $i < count($movies); $i++)
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <a href="{{ route('movies.show', $movies[$i]['id']) }}">
                                    <img id="image-front" class="img-fluid" img-fluid src="{{ asset('uploadedimages/' . $images[$i]) }}" alt="actor image">
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <a class="badge badge-secondary mb-3" href="{{ route('categories') }}">See more</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
