<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    // Просмотр темы + сообщений
    public function show(Topic $topic)
    {
        $posts = $topic->posts()->with('user')->get();

        return view('topics.show', compact('topic', 'posts'));
    }

    // Создание темы
    public function store(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Topic::create([
            'title' => $request->title,
            'category_id' => $category->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.show', $category);
    }

    // Удаление темы (только автор)
    public function destroy(Topic $topic)
    {
        if ($topic->user_id !== Auth::id()) {
            abort(403);
        }

        $topic->delete();

        return redirect()->route('categories.index');
    }
}

