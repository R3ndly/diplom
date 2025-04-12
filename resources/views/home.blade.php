@extends('layouts.app')
@section('styles')
    @vite(['resources/css/home.css'])
@endsection
@section('title', 'Главная страница аксесуаров для умного дома')
@section('content')

    <section class="welcome">
        <div class="container align-items-center">
            <div class="welcome__text">
                <h4 class="welcome__subtitle">Smart Home - самые умные дома!</h4>
                <h1 class="welcome__title">Зачем нужны умные дома?</h1>
                <p class="welcome__description">Мы считаем, что самый простой способ объяснить концепцию умного дома заключается в том, что это естественная эволюция наших домов.
                     Умный дом принципиально не отличается от «обычного» дома — это просто его улучшение. Точно так же, как электричество сделало наши дома лучше и функциональнее, так и связь улучшает то, как мы живем и используем наши дома.</p>
                <a href="#SHOP" class="btn">Заказать!</a>
            </div>
            <img src="/img/home.png" class="welcome__img" alt="Умный дом">
        </div>
    </section>

    <section class="advantages-list">
        <div class="container">
            <div class="advantages-list__card">
                <h4 class="advantages-list__title">Экономия на коммунальных платежах</h4>
                <p class="advantages-list__description">Умные технологии позволяют оптимизировать потребление энергии и ресурсов, что может снизить расходы на коммунальные услуги до 35%</p>
            </div>

            <div class="advantages-list__card">        
                <h4 class="advantages-list__title">Повышение безопасности</h4>
                <p class="advantages-list__description">Умные дома оснащены системами видеонаблюдения, сигнализации и датчиками, которые могут обнаруживать утечки газа или воды. </p>
            </div>

            <div class="advantages-list__card">
                <h4 class="advantages-list__title">Комфорт и удобство</h4>
                <p class="advantages-list__description">Умный дом позволяет автоматизировать множество рутинных задач, таких как управление светом и температурой. Владельцы могут настроить систему под себя</p>
            </div>

            <div class="advantages-list__card">
                <h4 class="advantages-list__title">Удаленный доступ и управление</h4>
                <p class="advantages-list__description">Владельцы могут управлять всеми устройствами в доме через мобильное приложение, находясь вдали от дома, что делает жизнь более удобной, нежели в обычном доме</p>
            </div>
        </div>
    </section>

    <section class="order">
        <div class="container">
            <img src="/img/доля_рынка.jpg" class="order__img">

            <div class="order__text">
                <h3 class="order__title">Мы самые крупные в России!</h3>
                <p class="order__description">Наша компания была первой среди стран СНГ, которая начала продавать умные дома.<br>Мы строились, развивались и улучшались - всё ради ВАС!</p>
            </div>
        </div> 
    </section>

    <section class="feedback">
        <div class="container">
            <img src="/img/feedback.png" class="feedback__img">
            <div class="feedback__text">
                <p class="feedback__description">Благодарим за хороший сервис, за самый умный дом и быстро выполненую работу. Благодаря компрании Smart Home мы прикоснулись к будущему и к большему количеству комфорта!</p>
                <p class="feedback__author">Отзывы клиентов</p>
                <span class="feedback__sub-author">Со всего СНГ</span>
            </div>
        </div>
    </section>

    <section class="download">
        <div class="container">
            <p class="download__title">Загрузить примеры работ с интерьером и функционалом умного дома</p>
            <a class="btn" download="">Скачать!</a>
        </div>
    </section>
@endsection