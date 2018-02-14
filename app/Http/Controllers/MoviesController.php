<?php

namespace App\Http\Controllers;

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
        return view('movies.create', compact('categories'));
    }

    public function store(StoreMovieRequest $request)
    {
        Movie::create($request->except('_token') + ['user_id' => Auth::user()->id]);

        return redirect()->route('movies');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        return view('movies.edit', compact('movie', 'categories'));
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        Movie::findOrFail($id)->update($request->except('_token') + ['user_id' => Auth::user()->id]);

        return redirect()->route('movies');
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return view('movies.show', compact('movie'));
    }

    public function destroy($id)
    {
        Movie::findOrFail($id)->delete();
        return redirect()->route('movies');
    }
}
