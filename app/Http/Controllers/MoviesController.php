<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Movie;
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
        $categories = Category::all();
        $actors = Actor::All();
        return view('movies.edit', compact('movie', 'categories', 'actors'));
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->except('_token') + ['user_id' => Auth::user()->id]);
        $movie->actors()->detach($request->input('actors'));
        $movie->actors()->attach($request->input('actors'));

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
        // $image = $movie->images()->featured();
        return view('movies.show', compact('movie', 'actors', 'img'));
    }

    public function destroy($id)
    {
        Movie::findOrFail($id)->delete();
        return redirect()->route('movies');
    }
}
