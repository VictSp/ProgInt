@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <h1>Категории форума</h1>

    <ul class="list-group">
        @forelse($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('categories.show', $category) }}">
                    {{ $category->title }}
                </a>
            </li>
        @empty
            <li class="list-group-item">Категорий пока нет</li>
        @endforelse
    </ul>
@endsection
