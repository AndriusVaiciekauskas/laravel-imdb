<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;
use App\Image;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActorsController extends Controller
{
    public function index()
    {
        $actors = Actor::paginate(10);
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
        $actor_movies = $actor->movies;
        $movies = Movie::all();
        return view('actors.edit', compact('actor', 'movies', 'actor_movies'));
    }

    public function update(UpdateActorRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $actor->update($request->except('_token', 'movies') + ['user_id' => Auth::user()->id]);
        $actor->movies()->sync($request->input('movies'));

        return redirect()->route('actors.show', $id);
    }

    public function show($id)
    {
        /** @var Actor $actor */
        $actor = Actor::findOrFail($id);
        $movies = $actor->movies;
        $images = $actor->images()->limit(4)->get();
        $img = [];
        foreach ($images as $image) {
            array_push($img, $image->image);
        }

        return view('actors.show', compact('actor', 'movies', 'img', 'featured_image'));
    }

    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);
        $actor->movies()->detach();
        $actor->delete();
        return redirect()->back()->with('success', 'Actor successfuly delete.');
    }

    public function detachMovie($movie_id, $actor_id)
    {
        $actor = Actor::findOrFail($actor_id);
        $actor->movies()->detach($movie_id);
        return back();
    }
}
