@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Категории форума</h1>

    <div class="list-group">
        @forelse($categories as $category)
            <a href="{{ route('categories.show', $category) }}"
               class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $category->title }}</h5>
                <p class="mb-1 text-muted">{{ $category->description }}</p>
                <small>Тем: {{ $category->topics_count }}</small>
            </a>
        @empty
            <div class="alert alert-info">
                Категорий пока нет
            </div>
        @endforelse
    </div>
</div>
@endsection