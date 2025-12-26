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
        $this->authorizeAdmin();

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('title', 'description'));

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $this->authorizeAdmin();

        $category->delete();

        return redirect()->back();
    }

    // ----- ПРОВЕРКА АДМИНА -----

    private function authorizeAdmin(): void
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403);
        }
    }
}

