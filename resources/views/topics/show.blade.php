@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $topic->title }}</h2>
    <p class="text-muted">
        Автор: {{ $topic->user->name }}
    </p>

    <hr>

    <h5>Сообщения</h5>

    @foreach($topic->posts as $post)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $post->content }}</p>
                <small class="text-muted">
                    {{ $post->user->name }}
                </small>

                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Удалить</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach

    @auth
        <form action="{{ route('posts.store', $topic) }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control"
                          placeholder="Ваше сообщение" required></textarea>
            </div>
            <button class="btn btn-primary">Отправить</button>
        </form>
    @endauth
</div>
@endsection
