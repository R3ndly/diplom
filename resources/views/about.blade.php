@extends('layouts.app')
@section('title')О наших умных мастерских@endsection
@section('content')

<div class="container">
  <div class="row about-us">

    <img src="./img/mission.avif" class="about-us__img">
    <div class="about-us__text">
      <h3 class="about-us__title">Наша миссия</h3>
      <p>Мы стремимся сделать жизнь наших клиентов более комфортной и безопасной с помощью современных технологий. Наша цель — предоставить высококачественные аксессуары для умных домов по доступным ценам.</p>
    </div>

    
    <div class="about-us__text">
      <h3 class="about-us__title">Наши ценности</h3>
      <ul>
        <li>Качество: Мы гарантируем высокое качество всех наших товаров.</li>
        <li>Доступность: Мы стараемся сделать умные технологии доступными для каждого.</li>
        <li>Клиентоориентированность: Мы всегда на стороне наших клиентов и готовы помочь.</li>
      </ul>
    </div>
    <img src="./img/worth.png" class="about-us__img">


    <img src="./img/us-products.jpg" class="about-us__img">
    <div class="about-us__text">
      <h3 class="about-us__title">Наши продукты</h3>
      <p>Мы предлагаем широкий ассортимент аксессуаров для умного дома, включая:</p>
      <ul>
        <li>Умные лампочки</li>
        <li>Системы безопасности</li>
        <li>Умные термостаты</li>
        <li>Управление освещением и бытовой техникой</li>
      </ul>
    </div>
    
</div>

@endsection
