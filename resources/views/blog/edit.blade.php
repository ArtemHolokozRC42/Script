@extends('layouts.app')

@section('title', 'Редагування запису')

@section('content')
    <h1>Редагування запису</h1>

    <form method="POST" action="{{ route('blog.update', $blog) }}" novalidate>
        @csrf
        @method('PUT')
        @include('blog._form')
        <button type="submit">Зберегти зміни</button>
    </form>
@endsection
