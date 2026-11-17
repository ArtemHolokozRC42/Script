@extends('layouts.app')

@section('title', 'Нова мітка')

@section('content')
    <h1>Нова мітка</h1>

    <form method="POST" action="{{ route('filters.store') }}" novalidate>
        @csrf
        @include('filters._form')
        <button type="submit">Зберегти</button>
    </form>
@endsection
