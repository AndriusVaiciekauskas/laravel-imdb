<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Movie;
use App\Rating;
use App\Services\VisitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
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

        return redirect()->route('movies.show', $movie->id);
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

        return redirect()->route('movies.show', $id)->with('success', 'Movie has updated successfully.');
    }

    public function show($id, VisitService $visit)
    {
        $movie = Movie::findOrFail($id);
        $visit->count($movie);

        $actors = $movie->actors()->limit(10)->get();
        $images = $movie->images()->limit(4)->get();

        foreach ($images as $image) {
            $img[] = $image->image;
        }

        return view('movies.show', compact('movie', 'actors', 'img', 'user_rating'));
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->actors()->detach();
        $movie->ratings()->delete();
        $movie->delete();
        return redirect()->back()->with('success', 'Movie has been deleted successfully.');
    }

    public function detachActor($movie_id, $actor_id)
    {
        $movie = Movie::findOrFail($movie_id);
        $movie->actors()->detach($actor_id);
        return back()->with('success', 'Actor has been detached successfully.');
    }

    public function showCast($id)
    {
        $movie = Movie::findOrFail($id);
        $actors = $movie->actors;

        return view('movies.cast', compact('movie', 'actors'));
    }

    public function showImages($id)
    {
        $movie = Movie::findOrFail($id);
        $images = $movie->images;

        return view('movies.images', compact('images', 'movie'));
    }
}
