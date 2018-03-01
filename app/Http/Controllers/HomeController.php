<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Movie;
use App\Visit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = response()->json(['response' => 'This is get method']);

        $related_movies = Visit::where('visitable_type', 'App\Movie')->orderBy('visit_count', 'desc')->limit(10)->get();
        $related_actors = Visit::where('visitable_type', 'App\Actor')->orderBy('visit_count', 'desc')->limit(10)->get();

        $popular_movies = collect();
        foreach ($related_movies as $movie) {
            $popular_movies->push($movie->related);
        }

        $popular_actors = collect();
        foreach ($related_actors as $actor) {
            $popular_actors->push($actor->related);
        }

        $movies = Movie::orderBy('release_date', 'desc')->take(12)->get();
        return view('welcome', compact('movies', 'popular_movies', 'popular_actors', 'res'));
    }
}
