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
use Symfony\Component\HttpFoundation\File\File;

class ImagesController extends Controller
{
    public function storeActorImage(StoreFileRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $result = $request->file('image')->storePublicly('public/images');
        $file_name = basename($result);
        $uploaded_image = Image::create(['user_id' => Auth::user()->id, 'filename' => $file_name]);
        $actor->images()->create(['image_id' => $uploaded_image->id]);
        if ($request->input('movie_id') != '') {
            $movie = Movie::findOrFail($request->movie_id);
            $movie->images()->create(['image_id' => $uploaded_image->id]);
        }
        return back();
    }

    public function make_featured($image_id, $actor_id)
    {
        $image = Imagable::where('image_id', $image_id)->where('imagable_id', $actor_id)->where('imagable_type', 'App\Actor');
        $actor = Actor::findOrFail($actor_id);

        $featured_image = $actor->images()->where('featured', 1);
        $featured_image->update(['featured' => 0]);
        $image->update(['featured' => 1]);
        return back();
    }

    public function destroy($image_id, $actor_id)
    {
        $imagable = Imagable::where('image_id', $image_id)->where('imagable_id', $actor_id)->where('imagable_type', 'App\Actor');
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
