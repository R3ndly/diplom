@extends('layouts.app')
@section('title') Регистрация @endsection
@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="login__form p-4 " style="width: 24rem;">
        <h1 class="text-center mb-4">Регистрация</h1>

        <form method="POST" action="{{ route('register_procces') }}" class="mb-4">
            @csrf

            <input name="name" type="text" class="form-control mb-3 @error('name') is-invalid @enderror" placeholder="Имя" />

            @error('name')
                <div class="invalid-feedback">Странное имя...</div>
            @enderror

            <input name="email" type="text" class="form-control mb-3 @error('email') is-invalid @enderror" placeholder="Email" />

            @error('email')
                <div class="invalid-feedback">Некорректный Email</div>
            @enderror

            <input name="password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" placeholder="Пароль" />

            @error('password')
                <div class="invalid-feedback">Вы ошиблись</div>
            @enderror

            <input name="password_confirmation" type="password" class="form-control mb-3 @error('password_confirmation') is-invalid @enderror" placeholder="Подтверждение пароля" />

            @error('password_confirmation')
                <div class="invalid-feedback">Пароли не совпадают</div>
            @enderror

            <div class="mb-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-primary">Есть аккаунт?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection
