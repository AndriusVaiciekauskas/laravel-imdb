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
    public function storeActorImage(StoreFileRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $result = $request->file('image')->storePublicly('public/images');
        $file_name = basename($result);
        $actor->images()->create(['user_id' => Auth::user()->id, 'filename' => $file_name]);
        return back();
    }

    public function make_featured($id)
    {
        $image = Image::findOrFail($id);
        $actor = $image->imagable;
        $featured_image = $actor->images()->where('featured', 1);
        $featured_image->update(['featured' => 0]);
        $image->update(['featured' => 1]);
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
