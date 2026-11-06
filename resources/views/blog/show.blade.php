@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <h1>{{ $blog->title }}</h1>

    <p class="blog-meta">
        {{ $blog->category?->category_name ?? 'Без категорії' }}
        · {{ $blog->author?->name ?? 'Редакція' }}
        · {{ $blog->dt_created->format('d.m.Y H:i') }}
    </p>

    <p><strong>{{ $blog->description }}</strong></p>
    <p style="white-space: pre-line">{{ $blog->text }}</p>

    <p>
        <a href="{{ route('blog.edit', $blog) }}">Редагувати</a> |
        <a href="{{ route('blog.index') }}">До блогу</a>
    </p>
@endsection
