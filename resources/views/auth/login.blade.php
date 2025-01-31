@extends('layouts.app')
@section('title') Авторизация @endsection
@section('content')

<div class="container d-flex justify-content-center align-items-center vh-10">
    <div class="card-1 shadow p-4 login__form">
        <h1 class="text-center mb-4">Вход</h1>

        <form method="POST" action="{{ route('login_procces') }}" class="mb-4">
            @csrf

            <input name="email" type="text" class="form-control mb-3 @error('email') is-invalid @enderror" placeholder="Email" />

            @error('email')
                <div class="invalid-feedback">Некорректный Email</div>
            @enderror

            <input name="password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" placeholder="Пароль" />

            @error('password')
                <div class="invalid-feedback">Не тот пароль...</div>
            @enderror

            

            <div class="mb-3">
                <a href="{{ route('register')}}" class="text-decoration-none text-primary">Регистрация</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </form>
    </div>
</div>
@endsection
