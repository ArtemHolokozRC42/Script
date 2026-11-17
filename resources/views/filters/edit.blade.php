@extends('layouts.app')

@section('title', 'Редагування мітки')

@section('content')
    <h1>Редагування мітки</h1>

    <form method="POST" action="{{ route('filters.update', $filter) }}" novalidate>
        @csrf
        @method('PUT')
        @include('filters._form')
        <button type="submit">Зберегти зміни</button>
    </form>
@endsection
