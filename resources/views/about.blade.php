@extends('layouts.app')
@section('styles')
    @vite(['resources/css/about.css'])
@endsection
@section('title')Об умных нас@endsection
@section('content')

<section class="welcome">
    <div class="text_info">
        <h2>Smart Home</h2>
        <div class="title">
            <h1>Make everything feel <span class="blue_word">easy</span></h1>
        </div>
        <div class="sub_title">
            <h4>Удалённое управление интеллектуальной настройки, доступно в вашем доме.</h4>
        </div>
        <a href="/products" class="btn">Заказать!</a>
        <div class="checkmark">
            <p><img src="./img/checkmark.png"> Обеспечте себя самой комфортной средой</p>
            <p><img src="./img/checkmark.png"> Следующий уровень комфорта</p>
        </div>
    </div>
    <div class="image_hand">
        <img src="./img/hand27.png" class="hand27">
    </div>
</section>

@endsection
