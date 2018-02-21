<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests\StoreFileRequest;
use App\Image;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MoviesImagesController extends Controller
{
    public function storeMovieImage(StoreFileRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $result = $request->file('image')->storePublicly('public/images');
        $file_name = basename($result);
        $uploaded_image = Image::create(['user_id' => Auth::user()->id, 'filename' => $file_name]);
        $movie->images()->create(['image_id' => $uploaded_image->id]);
        if ($request->input('actor_id') != '') {
            $actor = Actor::findOrFail($request->actor_id);
            $actor->images()->create(['image_id' => $uploaded_image->id]);
        }
        return back();
    }

//    public function make_featured($id)
//    {
//        $image = Image::findOrFail($id);
//        $movie = $image->imagable;
//        $featured_image = $movie->images()->where('featured', 1);
//        $featured_image->update(['featured' => 0]);
//        $image->update(['featured' => 1]);
//        return back();
//    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        Storage::delete('public/images/' . $image->filename);
        return back();
    }
}
