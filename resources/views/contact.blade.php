@extends('layouts.app')

@section('title', 'Контакти')

@section('content')
    <h1>Зворотний зв'язок {{ $platformName }}</h1>
    <p>Питання щодо купівлі гри, ключа активації чи повернення коштів? Напишіть нам, і ми відповімо на вказаний email.</p>

    <form method="POST" action="{{ route('contact.send') }}" novalidate>
        @csrf

        <div class="field">
            <label for="name">Ім'я</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="message">Повідомлення</label>
            <textarea id="message" name="message" rows="5">{{ old('message') }}</textarea>
            @error('message')<div class="error">{{ $message }}</div>@enderror
        </div>

        <button type="submit">Надіслати</button>
    </form>
@endsection
