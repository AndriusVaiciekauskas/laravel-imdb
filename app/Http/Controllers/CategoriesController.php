<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->except('_token') + ['user_id' => Auth::user()->id]);

        return redirect()->route('categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        Category::findOrFail($id)->update($request->except('_token') + ['user_id' => Auth::user()->id]);

        return redirect()->route('categories');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $movies = $category->movies;

        foreach ($movies as $movie) {
            $actors_ids[] = $movie->actors()->pluck('id');
        }

        $collection = collect($actors_ids);
        $flatened = $collection->flatten();
        $occurences = array_count_values($flatened->toArray());
        arsort($occurences);

        $sliced = array_slice($occurences, 0, 3, true);

        foreach ($sliced as $key => $value) {
            $actors[] = Actor::findOrFail($key);
        }

        return view('categories.show', compact('category', 'actors'));
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('categories');
    }
}
