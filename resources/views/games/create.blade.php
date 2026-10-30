@extends('layouts.app')

@section('title', 'Додати гру')

@section('content')
    <h1>Додати гру</h1>

    <form method="POST" action="{{ route('games.store') }}" novalidate>
        @csrf
        @include('games._form')
        <button type="submit">Зберегти</button>
    </form>
@endsection
