@extends('layouts.app')

@section('title', 'Дякуємо!')

@section('content')
    <h1>Дякуємо, {{ session('sender_name', 'друже') }}!</h1>
    <p>Ваше повідомлення надіслано. Ми зв'яжемося з вами найближчим часом.</p>
    <a href="{{ url('/') }}">Повернутися на головну</a>
@endsection
