<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Movie;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function store(StoreRatingRequest $request, $id)
    {
        $rating = Auth::user()->ratings()->where('movie_id', $id)->first();

        if ($rating !== null) {
            return back()->with('error', 'You voted allready.');
        }

        Rating::create($request->only('rating') + ['movie_id' => $id, 'user_id' => Auth::user()->id]);
        return back()->with('success', 'Thank you for your vote!');
    }

    public function get_top()
    {
        $movies = Movie::all();
        foreach ($movies as $movie) {
            echo $movie->name . "<br>";
            echo $movie->ratings->avg('rating') . "<br>";
        }
    }
}
