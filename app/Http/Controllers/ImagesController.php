<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests\StoreFileRequest;
use App\Image;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class ImagesController extends Controller
{
    public function index()
    {
        $actors = Actor::all();
        $movies = Movie::all();
        return view('images.index', compact('actors', 'movies'));
    }

    public function store(StoreFileRequest $request)
    {
        $imageName = date('Y_m_d_H_i_s') . $request->image->getClientOriginalName();
        $request->image->move(public_path('/uploadedimages'), $imageName);
        Image::create($request->except('_token', 'image') + ['user_id' => Auth::user()->id, 'filename' => $imageName]);
        return back()->with('success', 'Image uploaded!');
    }
}
