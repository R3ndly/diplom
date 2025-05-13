@extends('layouts.app')

@section('styles')
    @vite(['resources/css/home.css'])
@endsection

@section('title') Регистрация @endsection

@section('content')
<br>
<div class="container d-flex justify-content-center align-items-center">
    <div class="card-1 shadow p-4 login__form">
        <h1 class="text-center mb-4">Регистрация</h1>

        <form id="registerForm" class="mb-4">
            <input name="name" type="text" class="form-control mb-3" placeholder="Имя" required>
            <div class="invalid-feedback name-error"></div>

            <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
            <div class="invalid-feedback email-error"></div>

            <input name="password" type="password" class="form-control mb-3" placeholder="Пароль" required>
            <div class="invalid-feedback password-error"></div>

            <input name="password_confirmation" type="password" class="form-control mb-3" placeholder="Подтверждение пароля" required>
            <div class="invalid-feedback password_confirmation-error"></div>

            <div class="mb-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-primary">Уже есть аккаунт?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Очистка предыдущих ошибок
        document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        try {
            // 1. Получаем CSRF-куки
            const csrfResponse = await fetch('http://127.0.0.1:8000/sanctum/csrf-cookie', {
                credentials: 'include',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            // 2. Извлекаем токен из куки
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

            // 3. Отправляем запрос на регистрацию
            const response = await fetch('http://127.0.0.1:8000/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-XSRF-TOKEN': xsrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'include',
                body: JSON.stringify({
                    name: form.name.value,
                    email: form.email.value,
                    password: form.password.value,
                    password_confirmation: form.password_confirmation.value
                })
            });

            if (response.status === 419) {
                throw new Error('Сессия истекла. Перезагрузите страницу.');
            }

            const data = await response.json();

            if (!response.ok) {
                // Обработка ошибок валидации
                if (data.errors) {
                    for (const [field, errors] of Object.entries(data.errors)) {
                        const errorElement = document.querySelector(`.${field}-error`);
                        if (errorElement) {
                            errorElement.textContent = errors.join(', ');
                            form[field].classList.add('is-invalid');
                        }
                    }
                } else if (data.message) {
                    alert(data.message);
                }
                return;
            }

            // Успешная регистрация
            localStorage.setItem('auth_token', data.token);
            window.location.href = '/';

        } catch (error) {
            console.error('Ошибка:', error);
            alert(error.message || 'Ошибка регистрации');
        }
    });
});
</script>
@endsection
