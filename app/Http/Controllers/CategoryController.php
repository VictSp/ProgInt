<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Главная страница — список категорий
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    // Просмотр одной категории + её тем
    public function show(Category $category)
    {
        $topics = $category->topics()->latest()->get();

        return view('categories.show', compact('category', 'topics'));
    }

    // ----- АДМИН -----

    public function adminIndex()
    {
        abort_unless(\Gate::allows('admin'), 403);


        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('admin'), 403);


        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('title', 'description'));

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        abort_unless(\Gate::allows('admin'), 403);

        $category->delete();

        return redirect()->back();
    }

}

