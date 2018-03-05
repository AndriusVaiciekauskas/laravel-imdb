<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Movie;
use App\Rating;
use Carbon\Carbon;
use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getTop()
    {
        $movies = Movie::leftJoin('ratings', 'movies.id', '=', 'ratings.movie_id')
            ->selectRaw('round(avg(rating),1) as rating, movies.name, movies.id')
            ->groupBy('movies.id')
            ->orderBy('rating', 'desc')
            ->limit(10)
            ->get();

        return view('movies.top', compact('movies'));
    }
}
