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
    public function storeMovieImage(StoreFileRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $result = $request->file('image')->storePublicly('public/images');
        $file_name = basename($result);
        $movie->images()->create(['user_id' => Auth::user()->id, 'filename' => $file_name]);
        return back();
    }

    public function storeActorImage(StoreFileRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $result = $request->file('image')->storePublicly('public/images');
        $file_name = basename($result);
        $actor->images()->create(['user_id' => Auth::user()->id, 'filename' => $file_name]);
        return back();
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        Storage::delete('public/images/' . $image->filename);
        return back();
    }
}
