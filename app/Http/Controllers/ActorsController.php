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
        Actor::findOrFail($id)->delete();
        return redirect()->route('actors');
    }
}
