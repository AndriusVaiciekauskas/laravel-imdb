<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Movie;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $categories = Category::all();
        $actors = Actor::All();
        return view('movies.create', compact('categories', 'actors'));
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->except('_token', 'actors') + ['user_id' => Auth::user()->id]);
        $movie->actors()->attach($request->input('actors'));
        return redirect()->route('movies');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $movie_actors = $movie->actors;
        $categories = Category::all();
        $actors = Actor::All();
        return view('movies.edit', compact('movie', 'categories', 'actors', 'movie_actors'));
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->except('_token') + ['user_id' => Auth::user()->id]);
        $movie->actors()->sync($request->input('actors'));

        return redirect()->route('movies');
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $actors = $movie->actors;
        $images = $movie->images()->limit(4)->get();
        $img = [];
        foreach ($images as $image) {
            array_push($img, $image->image);
        }

        if (Auth::user() !== null) {
            $user_rating = Auth::user()->ratings()->where('movie_id', $id)->first();
        }

        $rating = Rating::where('movie_id', $id)->avg('rating');
        $rating = number_format($rating,1);
        return view('movies.show', compact('movie', 'actors', 'img', 'user_rating', 'rating'));
    }

    public function destroy($id)
    {
        Movie::findOrFail($id)->delete();
        return redirect()->route('movies');
    }

    public function detachActor($movie_id, $actor_id)
    {
        $movie = Movie::findOrFail($movie_id);
        $movie->actors()->detach($actor_id);
        return back();
    }
}
