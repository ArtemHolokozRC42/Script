@extends('layouts.app')

@section('title', 'Редагування гри')

@section('content')
    <h1>Редагування гри</h1>

    <form method="POST" action="{{ route('games.update', $game) }}" novalidate>
        @csrf
        @method('PUT')
        @include('games._form')
        <button type="submit">Зберегти зміни</button>
    </form>
@endsection
