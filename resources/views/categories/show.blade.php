@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->title }}</h1>
    <p class="text-muted">{{ $category->description }}</p>

    <hr>

    <h4>Темы</h4>

    @auth
            <form method="POST" action="{{ route('topics.store', $category) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Название темы</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Сообщение</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>

        <button class="btn btn-primary">Создать тему</button>
    </form>
    @endauth

    <ul class="list-group">
        @forelse($category->topics as $topic)
            <li class="list-group-item d-flex justify-content-between">
                <a href="{{ route('topics.show', $topic) }}">
                    {{ $topic->title }}
                </a>

                @can('delete', $topic)
                    <form action="{{ route('topics.destroy', $topic) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Удалить</button>
                    </form>
                @endcan
            </li>
        @empty
            <li class="list-group-item text-muted">
                Тем пока нет
            </li>
        @endforelse
    </ul>
</div>
@endsection
