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
}
