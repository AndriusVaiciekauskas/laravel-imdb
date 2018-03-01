<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->search == '') {
            return back();
        }
        
        $movies = Movie::where('name', 'like', '%' . $request->search . '%')->limit(20)->get();
        $actors = Actor::where('name', 'like', '%' . $request->search . '%')->limit(20)->get();

        return view('search.index', compact('movies', 'actors'));
    }

    public function moviesSearch(Request $request)
    {
        if ($request->search == '') {
            return back();
        }

        $movies = Movie::where('name', 'like', '%' . $request->search . '%')->limit(20)->get();

        return view('search.movies', compact('movies'));
    }

    public function actorsSearch(Request $request)
    {
        if ($request->search == '') {
            return back();
        }

        $actors = Actor::where('name', 'like', '%' . $request->search . '%')->limit(20)->get();

        return view('search.actors', compact('actors'));
    }

    public function suggest(Request $request)
    {
        $movies = Movie::where('name', 'like', '%' . $request->search . '%')->limit(10)->get();
        $actors = Actor::where('name', 'like', '%' . $request->search . '%')->limit(10)->get();
        $merged = $movies->merge($actors);
        return response()->json(['response' => $merged]);

    }
}
