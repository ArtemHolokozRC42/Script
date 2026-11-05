@extends('layouts.app')

@section('title', 'Новий запис')

@section('content')
    <h1>Новий запис</h1>

    <form method="POST" action="{{ route('blog.store') }}" novalidate>
        @csrf
        @include('blog._form')
        <button type="submit">Зберегти</button>
    </form>
@endsection
