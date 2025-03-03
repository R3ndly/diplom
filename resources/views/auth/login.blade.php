@extends('layouts.app')
@section('title') Авторизация @endsection
@section('content')
<br>
<div class="container d-flex justify-content-center align-items-center">
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
<br><br><br><br>
<section class="advantages-list">
            <div class="container">
                <div class="log">
                    <h4 class="advantages-list__title">Персонализированный опыт</h4>
                    <p class="advantages-list__description">Создайте свой аккаунт, чтобы получить доступ к индивидуальным рекомендациям и настройкам, которые сделают ваш умный дом еще удобнее.</p>
                </div>

                <div class="log">
                    <h4 class="advantages-list__title">Один аккаунт на все устройства</h4>
                    <p class="advantages-list__description">На телефоне и на всех других устройствах вам будет удобно пользоваться нашими приложениями. Войдите в аккаунт на всех устройствах.</p>
                </div>

                <div class="log">
                    <h4 class="advantages-list__title">Поддержка 24/7</h4>
                    <p class="advantages-list__description">Станьте частью нашего сообщества и получите круглосуточную поддержку от нашей команды экспертов, готовых помочь вам в любой ситуации.</p>
                </div>
            </div>
        </section>

@endsection
