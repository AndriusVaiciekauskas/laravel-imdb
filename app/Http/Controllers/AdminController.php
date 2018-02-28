<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Image;
use App\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function movies()
    {
        $movies = Movie::with('category')->orderBy('release_date', 'desc')->paginate(10);
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

    public function images()
    {
        $images = Image::paginate(24);

        return view('admin.images', compact('images'));
    }

    public function destroy_image($id)
    {
        $image = Image::where('id', $id)->first();
        $image->imagable()->delete();
        $image->delete();
        return back()->with('success', 'Image deleted successfully.');
    }
}
