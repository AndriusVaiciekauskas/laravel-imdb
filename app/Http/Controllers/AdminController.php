<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function movies()
    {
        $movies = Movie::with('category')->paginate(10);
        return view('admin.movies', compact('movies'));
    }

    public function actors()
    {
        $actors = Actor::paginate(10);
        return view('admin.actors', compact('actors'));
    }

    public function categories()
    {
        $categories = Category::all();

        return view('admin.categories', compact('categories'));
    }
}
