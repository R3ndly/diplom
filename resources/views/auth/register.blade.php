@extends('layouts.app')

@section('title') Регистрация @endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="login__form p-4" style="width: 24rem;">
        <h1 class="text-center mb-4">Регистрация</h1>

        <form id="registerForm" class="mb-4">
            @csrf

            <input name="name" type="text" class="form-control mb-3" placeholder="Имя" required>
            <div class="invalid-feedback name-errors"></div>

            <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
            <div class="invalid-feedback email-errors"></div>

            <input name="password" type="password" class="form-control mb-3" placeholder="Пароль" required>
            <div class="invalid-feedback password-errors"></div>

            <input name="password_confirmation" type="password" class="form-control mb-3" placeholder="Подтверждение пароля" required>
            <div class="invalid-feedback password_confirmation-errors"></div>

            <div class="mb-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-primary">Есть аккаунт?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Очистка ошибок
        document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        try {
            // Получаем CSRF-токен
            await fetch('/sanctum/csrf-cookie');

            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    name: form.name.value,
                    email: form.email.value,
                    password: form.password.value,
                    password_confirmation: form.password_confirmation.value
                })
            });

            const data = await response.json();

            if (!response.ok) {
                // Обработка ошибок
                if (data.errors) {
                    for (const [field, errors] of Object.entries(data.errors)) {
                        const errorElement = document.querySelector(`.${field}-errors`);
                        if (errorElement) {
                            errorElement.textContent = errors.join(', ');
                            form[field].classList.add('is-invalid');
                        }
                    }
                }
                return;
            }

            // Успешная регистрация и авторизация
            window.location.href = "{{ route('home') }}";

        } catch (error) {
            console.error('Ошибка:', error);
        }
    });
});
</script>
@endsection
