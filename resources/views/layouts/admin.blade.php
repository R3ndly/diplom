<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/home.css', 'resources/css/app.css', 'resources/css/about.css', 'resources/css/contact.css', 'resources/css/pageBD.css'])
    
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom header">
        <a href="/" class="d-flex align-items-center text-decoration-none">
        <span class="fs-4 px-5">Smart Home - ваш умный дом ADMIN</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto nav-menu">
            <a class="me-3 py-2 text-decoration-none" href="/contact">Наши контакты</a>
            <a class="me-3 py-2 text-decoration-none" href="/about">О нас</a>

            @auth 
                @if (Auth::user())
                    <a class="me-3 py-2 text-decoration-none" href="/admin/products">Товары</a>
                    <a class="me-3 py-2 text-decoration-none" href="/admin/workers">Сотрудники</a>
                    <a class="me-3 py-2 text-decoration-none" href="/admin/vacancies">Вакансии</a>

                    <a class="me-3 py-gray text-decoration-none btn btn-primary" href="{{ url('/cart') }}">Корзина</a>
                @endif
            @endauth
        
        @if (Auth::check())
        <div class="dropdown me-2">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  {{ Auth::user()->name }}
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a type="submit" class="btn btn-primary w-80 dropdown-item" href="{{ route('logout') }}">Выйти</a> </li>
  </ul>
</div> 
        @else
        <a type="submit" class="btn btn-primary w-80" href="{{ route('admin.login') }}">Войти</a>
        @endif
      </nav>
    </div>
        
    </div>
  </body>

</html>
