@extends('layouts.app')

@section('title', $category->title)

@section('content')
    <h1>{{ $category->title }}</h1>
    <p>{{ $category->description }}</p>

    <h3>Темы</h3>

    <ul class="list-group mb-3">
        @forelse($topics as $topic)
            <li class="list-group-item">
                <a href="{{ route('topics.show', $topic) }}">
                    {{ $topic->title }}
                </a>
            </li>
        @empty
            <li class="list-group-item">Тем пока нет</li>
        @endforelse
    </ul>

    @auth
        <form method="POST" action="{{ route('topics.store', $category) }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Название темы">
            </div>
            <button class="btn btn-primary">Создать тему</button>
        </form>
        @else
            <p>Чтобы создать тему, войдите в аккаунт.</p>
    @endauth
@endsection
