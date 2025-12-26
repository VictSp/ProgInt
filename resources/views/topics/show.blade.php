@extends('layouts.app')

@section('title', $topic->title)

@section('content')
    <h1>{{ $topic->title }}</h1>

    <ul class="list-group mb-3">
        @foreach($posts as $post)
            <li class="list-group-item">
                <strong>{{ $post->user->name }}:</strong>
                {{ $post->content }}

                @auth
                    @if($post->user_id === auth()->id())
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    @endif
                @endauth
            </li>
        @endforeach
    </ul>

    @auth
        <form method="POST" action="{{ route('posts.store', $topic) }}">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Ваше сообщение"></textarea>
            </div>
            <button class="btn btn-primary">Отправить</button>
        </form>
    @endauth
@endsection
