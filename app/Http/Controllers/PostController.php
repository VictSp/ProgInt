<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Создание сообщения
    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Post::create([
            'content' => $request->input('content'),
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('topics.show', $topic);
    }

    // Удаление сообщения (только автор)
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->back();
    }
}

