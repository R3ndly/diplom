<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css','resources/css/pageBD.css'])
    @yield('styles')
</head>
<body>

@if(Auth::check() && Auth::user()->isAdmin())
    @include('layouts.admin')
@else
    <div class="d-flex align-items-center pb-3 mb-4 border-bottom header">
        <a href="/" class="d-flex align-items-center text-decoration-none header__title">
            <span class="px-5">Smart Home - ваш умный дом</span>
        </a>

        <nav class="mt-2 mt-md-0 ms-md-auto nav-menu">
            <a class="py-2 text-decoration-none" href="/contact">Контакты</a>
            <a class="py-2 text-decoration-none" href="/about">О нас</a>

            @auth
                @if (Auth::user())
                    <a class="py-2 text-decoration-none" href="/products">Товары</a>
                    <a class="py-2 text-decoration-none" href="/vacancies">Вакансии</a>

                    <a class="py-gray text-decoration-none btn btn-primary" href="{{ url('/cart') }}">Корзина</a>
                @endif
            @endauth

            @if (Auth::check())
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-80 dropdown-item">Выйти</button>
                        </form>
                    </ul>
                </div>
            @else
                <a type="submit" class="btn btn-primary w-80" href="{{ route('login') }}">Войти</a>
            @endif
        </nav>
    </div>
@endif

<main class="py-4">
    @yield('content')
</main>

<footer class="footer">
        <div class="container">
            <div></div>

            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-title footer__menu">
                        <h3>Примеры работ</h3>
                        <ul class="footer__inner-list">
                            <li class="footer__list-item"><a href="#1">Малый бюджет</a></li>
                            <li class="footer__list-item"><a href="#2">Средний бюджет</a></li>
                            <li class="footer__list-item"><a href="#3">Большой бюждет</a></li>
                        </ul>
                    </li>

                    <li class="footer__list-title footer__info">
                        <h3>Информация</h3>
                        <ul class="footer__inner-list">
                            <li class="footer__list-item"><a href="/about">О нас</a></li>
                            <li class="footer__list-item"><a href="/contact">Контакты</a></li>
                            <li class="footer__list-item"><a href="/logout">Войти</a></li>
                        </ul>
                    </li>

                    <li class="footer__list-title footer__links">
                        <h3>Ссылки</h3>
                        <ul class="footer__inner-list">
                            <li class="footer__list-item"><a href="#7">Наши мастера</a></li>
                            <li class="footer__list-item"><a href="#8">Поддержка</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="footer__socials">
                <h3>Социальные сети</h3>
                <div class="footer__socials-icons">
                    <ul class="footer__icons-list">
                        <li class="footer__list-item"><a href="#facebook"><img src="/img//facebook 1.png" alt="facebook"></a></li>
                        <li class="footer__list-item"><a href="#twitter"><img src="/img/twitter 1.png" alt="twitter"></a></li>
                        <li class="footer__list-item"><a href="#instagram"><img src="/img/instagram 1.png" alt="instagram"></a></li>
                        <li class="footer__list-item"><a href="#linkedin"><img src="/img/linkedin 1.png" alt="linkedin"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<script>
document.querySelector('.logout-btn')?.addEventListener('click', (e) => {
    e.preventDefault();

    fetch("{{ route('logout') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    }).then(() => {
        window.location.reload();
    });
});
</script>
</body>
</html>
