<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests\StoreFileRequest;
use App\Imagable;
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

    public function make_featured($image_id, $movie_id)
    {
        $image = Imagable::where('image_id', $image_id)->where('imagable_id', $movie_id)->where('imagable_type', 'App\Movie');
        $movie = Movie::findOrFail($movie_id);

        $featured_image = $movie->images()->where('featured', 1);
        $featured_image->update(['featured' => 0]);
        $image->update(['featured' => 1]);
        return back();
    }

    public function destroy($image_id, $movie_id)
    {
        $imagable = Imagable::where('image_id', $image_id)->where('imagable_id', $movie_id)->where('imagable_type', 'App\Movie');
        $images = Imagable::where('image_id', $image_id)->get();

        if (count($images) == 1) {
            $imagable->delete();
            $image = Image::findOrFail($image_id);
            $image->delete();
            Storage::delete('public/images/' . $image->filename);
        } else {
            $imagable->delete();
        }



        return back();
    }
}
