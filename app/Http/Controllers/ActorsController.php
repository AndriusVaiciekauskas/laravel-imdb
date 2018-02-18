<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActorsController extends Controller
{
    public function index()
    {
        $actors = Actor::all();
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        $movies = Movie::all();
        return view('actors.create', compact('movies'));
    }

    public function store(StoreActorRequest $request)
    {
        $actor = Actor::create($request->except('_token', 'movies') + ['user_id' => Auth::user()->id]);
        $actor->movies()->attach($request->input('movies'));

        return redirect()->route('actors');
    }

    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        $movies = Movie::all();
        return view('actors.edit', compact('actor', 'movies'));
    }

    public function update(UpdateActorRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $actor->update($request->except('_token', 'movies') + ['user_id' => Auth::user()->id]);
        $actor->movies()->detach($request->input('movies'));
        $actor->movies()->attach($request->input('movies'));

        return redirect()->route('actors');
    }

    public function show($id)
    {
        $actor = Actor::findOrFail($id);
        $image = $actor->images->first();
        $images = $actor->images()->limit(4)->get();
        $movie_images = $actor->movies();
        return view('actors.show', compact('actor', 'image', 'images', 'movie_images'));
    }

    public function destroy($id)
    {
        Actor::findOrFail($id)->delete();
        return redirect()->route('actors');
    }
}
