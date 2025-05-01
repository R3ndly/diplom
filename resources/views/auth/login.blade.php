@extends('layouts.app')

@section('styles')
    @vite(['resources/css/home.css'])
@endsection

@section('title') Авторизация @endsection

@section('content')
<br>
<div class="container d-flex justify-content-center align-items-center">
    <div class="card-1 shadow p-4 login__form">
        <h1 class="text-center mb-4">Вход</h1>

        <form id="loginForm" class="mb-4">
            <input name="email" type="text" class="form-control mb-3" placeholder="Email" required>
            <div class="invalid-feedback email-error"></div>

            <input name="password" type="password" class="form-control mb-3" placeholder="Пароль" required>
            <div class="invalid-feedback password-error"></div>

            <div class="mb-3">
                <a href="{{ route('register') }}" class="text-decoration-none text-primary">Регистрация</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // 1. Получаем CSRF-куки (ОБЯЗАТЕЛЬНО с явным URL)
        const csrfResponse = await fetch('http://127.0.0.1:8000/sanctum/csrf-cookie', {
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        // 2. Извлекаем токен из куки (новый способ)
        function getXsrfToken() {
            return document.cookie
                .split('; ')
                .find(row => row.startsWith('XSRF-TOKEN='))
                ?.split('=')[1];
        }
        const xsrfToken = decodeURIComponent(getXsrfToken() || '');

        if (!xsrfToken) {
            alert('Не удалось получить CSRF-токен!');
            return;
        }

        // 3. Отправляем запрос на вход
        try {
            const response = await fetch('http://127.0.0.1:8000/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-XSRF-TOKEN': xsrfToken, // Ключевой момент!
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'include', // Важно для кук!
                body: JSON.stringify({
                    email: form.email.value,
                    password: form.password.value
                })
            });

            if (response.status === 419) {
                throw new Error('Сессия истекла. Перезагрузите страницу.');
            }

            const data = await response.json();

            if (!response.ok) {
                alert(data.message || 'Ошибка входа');
                return;
            }

            // Успешная авторизация
            localStorage.setItem('auth_token', data.token);
            window.location.href = '/';

        } catch (error) {
            console.error('Ошибка:', error);
            alert(error.message || 'Ошибка авторизации');
        }
    });
});

</script>

@endsection
