<?php

namespace App\Http\Controllers;

use App\Movie;
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
        $movies = Movie::orderBy('id', 'desc')->take(6)->get();
        $images = [];
        foreach ($movies as $movie) {
            $image = $movie->images()->first();
            array_push($images, $image['filename']);
        }
        return view('welcome', compact('images', 'movies'));
    }
}
